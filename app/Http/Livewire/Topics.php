<?php

namespace App\Http\Livewire;

use App\Helper\Helper;
use App\Models\Discipline;
use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Smalot\PdfParser\Parser;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Spatie\PdfToText\Pdf;

class Topics extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search = '';
    public $perPage = 5;
    public $discipline;
    public $confirmingDeletion = 0;
    public $openModal = false;
    public $openImport = false;
    public $topicId = 0;
    public $topicNumber, $title, $tags;
    public $lastNumber = 0;
    public $topicsTitles;



    protected $rules = [
        'topicNumber' => 'required|numeric',
        'title' => 'required|string|max:255',
        'tags' => 'nullable|string|max:100',
    ];

    protected $messages = [
        'topicNumber.unique' => 'Тема с таким номером занятия уже есть!',
    ];

    public function mount(Discipline $discipline)
    {
        $this->discipline = $discipline;
    }

    public function render()
    {
        $topics = Topic::whereDisciplineId($this->discipline->id)
            ->orderBy('t_number')
            ->paginate($this->perPage);



        return view('livewire.topics', ['topics' => $topics]);
    }

    public function update(Topic $topic)
    {
        if($topic->id) {
            $this->topicId = $topic->id;
            $this->title = $topic->title;
            $this->tags = $topic->tags;
            $this->topicNumber = $topic->t_number;
        } else {
            $this->resetInputFields();
            $this->resetValidation();
        }

        $this->openModal = true;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function store()
    {
        $this->validate([
            'topicNumber' => 'required|numeric|unique:topics,t_number,' . $this->topicId . ',id,discipline_id,' . $this->discipline->id,

        ]);

        $topic = Topic::updateOrCreate(['id' => $this->topicId], [
            'discipline_id' => $this->discipline->id,
            'title' => $this->title,
            'tags' => $this->tags,
            't_number' => $this->topicNumber,
        ]);


        $message = $this->topicId ? 'Данные обновлены' : 'Тема добавлена';

        $this->emit('show-toast', $message, 'success');

        $this->closeModal();
    }

    public function deleteConfirmation(Topic $topic)
    {

        $this->topicId = $topic->id;
        $this->title = $topic->title;

        $this->confirmingDeletion = true;

    }

    public function delete()
    {
        Topic::destroy($this->topicId);

        $this->emit('show-toast', 'Тема удалена!', 'success');

        $this->confirmingDeletion = false;

    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    private function resetInputFields()
    {
        $this->topicId = 0;
        $this->title = '';
        $this->tags = '';
        $this->topicNumber = '';
    }

    public function closeModal()
    {
        $this->openModal = false;
        $this->resetInputFields();
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function import()
    {

        $tNumber = Topic::whereDisciplineId($this->discipline->id)
            ->orderByDesc('t_number')->limit(1)->pluck('t_number')->implode('');

        $i = $tNumber ?? 0;

        $separator = "\n";

        $topics = preg_replace('/[0-9]+/', '', $this->topicsTitles);

        $line = strtok($topics, $separator);

        while ($line !== false) {
            $i++;

            Topic::create([
                'discipline_id' => $this->discipline->id,
                'title' => $line,
                't_number' => $i,
            ]);


            $line = strtok( $separator );
        }

        $this->openImport = false;

        $this->emit('show-toast', 'Темы добавлены', 'success');

        $this->topicsTitles = '';


    }

    public function receiveFromVolgmed()
    {
        $localFilePath = 'import/'.$this->discipline->volgmed_id.'.pdf';

        $topicsLink = Helper::getLinksDisciplineFilesFromVOLGMED($this->discipline->volgmed_id, 'topics');

        if (App::environment('local')) {
            $pathToPdfToText = 'C:\laragon\bin\poppler-0.68.0\bin\pdftotext';
        } else {
            $pathToPdfToText = '/usr/bin/pdftotext';
        }

        $getFromVolgmed = Http::get('https://www.volgmed.ru/uploads/files/'.$topicsLink.'.pdf');

        $fileFromVolgmed= Storage::disk('local')->put($localFilePath, $getFromVolgmed->body());


        if($fileFromVolgmed){


            $text = (new Pdf($pathToPdfToText))
                ->setPdf(Storage::path($localFilePath))
                ->text();

            $a = strpos($text, 'Темы занятий');
            $b = strpos($text, '1 – тема');

            $topics = substr($text, $a, $b - $a);

            $topics = preg_replace('/[0-9]+/', '', $topics);

            foreach (preg_split("/((\r?\n)|(\r\n?))/", $topics) as $title){
                if(strpos($title, 'Темы')!==0){
                    $this->topicsTitles[] = str_replace("  ", "", $title);
                    }
                }

            Storage::delete($localFilePath);

            $this->emit('show-toast', 'Темы загружены', 'success');

        } else {
            $this->emit('show-toast', 'Ошибка загрузки с сайта volgmed.ru', 'warning');
        }
    }
}
