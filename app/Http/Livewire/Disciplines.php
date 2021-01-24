<?php

namespace App\Http\Livewire;

use App\Helper\Helper;
use App\Models\Discipline;
use App\Models\Faculty;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use PHPUnit\TextUI\Help;

class Disciplines extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 5;
    public $findByFaculty = 0;
    public $confirmingDeletion =0;
    public $confirmingSync =0;
    public $openModal = false;
    public $discipline_id = 0;
    public $name, $short_name, $faculty_id, $semester, $last_class_id;

    protected $rules = [
        'name' => 'required|string|min:6|max:255',
        'short_name' => 'required|string|max:15',
        'faculty_id' => 'required|integer',
        'semester' => 'required|digits_between:1,12|numeric',
        'last_class_id' => 'required|integer',
    ];

    public function render()
    {
        $disciplines = Discipline::search($this->search)
            ->whereDepartmentId(Auth::user()->department_id)
            ->when($this->findByFaculty != 0, function ($q) {
                return $q->whereFacultyId($this->findByFaculty);
            })
            ->orderBy('semester')
            ->with('faculty:id,name,speciality,color')
            ->paginate($this->perPage);

        $faculties = Faculty::all(['id','speciality']);

        return view('livewire.disciplines', [
            'disciplines' => $disciplines,
            'faculties' => $faculties,
        ]);
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function closeModal()
    {
        $this->openModal = false;
        $this->resetInputFields();
        $this->resetValidation();
    }

    public function update(Discipline $discipline)
    {

        if($discipline->id) {
            $this->discipline_id = $discipline->id;
            $this->name = $discipline->name;
            $this->short_name = $discipline->short_name;
            $this->faculty_id = $discipline->faculty_id;
            $this->semester = $discipline->semester;
            $this->last_class_id = $discipline->last_class_id;
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
        $this->validate();

        $discipline = Discipline::updateOrCreate(['id' => $this->discipline_id], [
            'name' => $this->name,
            'short_name' => $this->short_name,
            'faculty_id' => $this->faculty_id,
            'semester' => $this->semester,
            'last_class_id' => $this->last_class_id,
        ]);


        $message = $this->discipline_id ? 'Данные обновлены' : 'Пользователь добавлен';

        $this->emit('show-toast', $message, 'success');

        $this->closeModal();
    }

    public function deleteConfirmation(Discipline $discipline)
    {

        $this->discipline_id = $discipline->id;
        $this->name = $discipline->name;

        $this->confirmingDeletion = true;

    }

    public function delete()
    {
        Discipline::destroy($this->discipline_id);

        $this->emit('show-toast', 'Дисциплина удалена!', 'success');

        $this->confirmingDeletion = false;

    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    private function resetInputFields()
    {
        $this->discipline_id = 0;
        $this->name = '';
        $this->short_name = '';
        $this->faculty_id = 0;
        $this->last_class_id = 0;
        $this->semester = '';

    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function getDisciplineFromOffSite()
    {
        $this->confirmingSync = false;

        $faculties = Faculty::pluck('speciality', 'id')->toArray();

        $departmentId = Auth::user()->department_id;
        $departmentVolgmedId = Auth::user()->department->volgmed_id;


        // Get link
        $response = Http::get('https://www.volgmed.ru/ru/depts/list/'.$departmentVolgmedId.'/');

        $openTag = "Сотрудники</a></li><li><a href='https://www.volgmed.ru/ru/files/list/";
        $closeTag = "Материалы для скачивания";

        $pattern = "#".$openTag."(.*?)".$closeTag."#";

        preg_match($pattern, $response->body(), $match);


        $downloadLinkId = explode('/', $match[1])[0];

        $response = Http::get('https://www.volgmed.ru/ru/files/list/'.$downloadLinkId.'/');

        $openTag = "<tr><td class='GridTableBlue' width='18px;'><img src='https://www.volgmed.ru/templates/volgmu_pill/images/folder.gif' alt='Каталог' border='0'></td><td class='GridTableBlue'><a href='https://www.volgmed.ru/ru/files/list/";

        $closeTag = "03 О";

        $pattern = "#".$openTag."(.*?)".$closeTag."#";

        preg_match($pattern, $response->body(), $match);

        $facultyDisciplinesLinkId = explode('/', $match[1])[0];


        $links = Helper::getLinksArrayFromVOLGMED($facultyDisciplinesLinkId);



        foreach ($faculties as $facultyId => $facultySpeciality) {


            $filtered = Arr::where($links, function ($value) use ($facultySpeciality) {

                if(Str::contains($value['name'], $facultySpeciality)) {
                    return $value;
                }

            });

            $filtered = array_values($filtered);



            if($filtered) {
                $linksNextFolder = Helper::getLinksArrayFromVOLGMED($filtered[0]['id']);


                if($linksNextFolder[0]['name'] == 'Дисциплины'){

                    $linksNextNextFolder = Helper::getLinksArrayFromVOLGMED($linksNextFolder[0]['id']);

                    collect($linksNextNextFolder)->each(function (array $row) use ($departmentId, $facultyId) {

                        $disciplines = Discipline::updateOrCreate(
                            [
                                'department_id' => $departmentId,
                                'faculty_id' => $facultyId,
                                'volgmed_id' => $row['id'],
                            ],
                            [
                                'name' => $row['name'],
                                'department_id' => $departmentId,
                                'faculty_id' => $facultyId,
                                'volgmed_id' => $row['id'],
                            ]
                        );
                    });

                }

                if(Str::contains($linksNextFolder[0]['name'], 'Дисциплина')){
                    $disciplineName = explode('&quot;', $linksNextFolder[0]['name']);

                    $disciplines = Discipline::updateOrCreate(
                        [
                            'volgmed_id' => $linksNextFolder[0]['id'],
                            'department_id' => $departmentId,
                            'faculty_id' => $facultyId,
                        ],
                        [
                            'name' => $disciplineName[1],
                            'department_id' => $departmentId,
                            'faculty_id' => $facultyId,
                            'volgmed_id' => $linksNextFolder[0]['id'],
                        ]
                    );


                }


            }


        }





        $this->emit('show-toast', 'Дисциплины добавлены', 'success');




    }
}
