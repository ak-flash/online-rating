<?php

namespace App\Http\Livewire;

use App\Models\Discipline;
use App\Models\Journal;
use App\Models\Student;
use App\Models\Topic;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Topics extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;
    public $discipline;
    public $confirmingDeletion = 0;
    public $openModal = false;
    public $topicId = 0;
    public $topicNumber, $title, $tags;
    public $lastNumber = 0;

    protected $rules = [
        'topicNumber' => 'required|numeric',
        'title' => 'required|string|max:255',
        'tags' => 'nullable|string|max:100',
    ];

    protected $messages = [
        'topicId.unique' => 'Тема с таким номером занятия уже есть!',
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
            'topicNumber' => 'required|numeric|unique:topics,t_number,'
                .$this->discipline->id,
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
}
