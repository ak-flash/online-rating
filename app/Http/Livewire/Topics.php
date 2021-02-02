<?php

namespace App\Http\Livewire;


use Helper;
use App\Models\Discipline;
use App\Models\Lesson;
use App\Models\Topic;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;


class Topics extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
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
        if(auth()->user()->isDepartmentWorker($discipline->department_id)) {
        $this->discipline = $discipline;
        } else {
            abort(403, 'Дисциплина не найдена');
        }
    }

    public function render()
    {
        $topics = Topic::search($this->search)
            ->whereDisciplineId($this->discipline->id)
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
        DB::transaction(function () {
            Lesson::whereTopicId($this->topicId)->update([
                'topic_id' => null,
            ]);

            Topic::findOrFail($this->topicId)->forceDelete();
        });

        $this->emit('show-toast', 'Тема удалена!', 'success');

        $this->topicId = 0;
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
        $this->validate([
            'topicsTitles' => 'required|string',
        ]);

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

        $this->emit('show-toast', '', 'Темы добавлены', 'success');

        $this->topicsTitles = '';

    }

    public function receiveFromVolgmed()
    {
        $localFilePath = 'import/'.$this->discipline->volgmed_id.'.pdf';

        $topicsLink = Helper::getLinksDisciplineFilesFromVOLGMED($this->discipline->volgmed_id, 'topics');

        $headers = ['Content-Type: application/pdf'];

        $getFromVolgmed = Http::get('https://www.volgmed.ru/uploads/files/'.$topicsLink.'.pdf');

        $fileName = explode('/', $topicsLink);

        Storage::disk('local')->put($localFilePath, $getFromVolgmed->body());

        return response()->download(Storage::path($localFilePath), $fileName[1].'pdf', $headers)->deleteFileAfterSend(true);
    }

}
