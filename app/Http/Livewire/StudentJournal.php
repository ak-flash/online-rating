<?php

namespace App\Http\Livewire;

use App\Models\Lesson;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;


class StudentJournal extends Component
{
    use WithPagination;

    public $student;
    public $search = '';
    public $perPage = 5;



    public function render()
    {



        //, DB::raw('COUNT(team_id) as count')
        $disciplines = Lesson::whereRaw('date IN (select MAX(date) FROM lessons WHERE `faculty_id` = '.(int)$this->student->faculty_id.' and `course_number` = '.(int)$this->student->course_number.' and `group_number` = '.(int)$this->student->group_number.' and `date` < "'.now().'" GROUP BY team_id)')
            ->groupBy('team_id')
            ->with(['user' => function ($query) {
                return $query->select('id', 'name', 'position', 'profile_photo_path');
            }, 'team' => function ($query) {
                return $query->select('id', 'name');
            }])
            ->get()->sortBy('team.name');

        // Variant 1
        /*selectRaw('teams.id as team_id, teams.name as team_name,users.name as user_name,users.position as user_position,users.profile_photo_path as user_photo_path, title, type, rating, lessons.id, max(lessons.updated_at) as updated_at, max(date) as date')
            ->whereCourseNumber($this->student->course_number)
            ->whereGroupNumber($this->student->group_number)
            ->where('date', '<=', now())->groupBy('team_id')
            ->join('teams', 'lessons.team_id', '=', 'teams.id')
            ->join('users', 'lessons.user_id', '=', 'users.id')
            ->orderBy('teams.name')
            ->paginate($this->perPage);*/

        // Variant 2 too slow
        /*findByStudentsGroup($this->student->faculty_id, $this->student->course_number, $this->student->group_number)
            ->selectRaw('tm.id as team_id,us.name as user_name,us.position as user_position,us.profile_photo_path as user_photo_path, tm.name as team_name, title, type, rating, lessons.id, max(lessons.updated_at) as updated_at, max(date) as date')
            ->where('date', '<=', now())
            ->orderBy('tm.name')
            ->groupBy('team_id')
            ->leftJoin('teams as tm', function ($q) {
                return $q->on('tm.id', '=', 'lessons.team_id');
            })
            ->leftJoin('users as us', function ($q) {
                return $q->on('us.id', '=', 'lessons.user_id');
            })
            ->when(!empty($this->search), function ($q) {
                return $q->where('us.name', 'like', '%'.$this->search.'%')
                    ->orWhere('tm.name', 'like', '%'.$this->search.'%');
            })
            ->paginate($this->perPage);*/
//






        $items = $disciplines->forPage($this->page, $this->perPage);

        $paginator = new LengthAwarePaginator($items, $disciplines->count(), $this->perPage, $this->page);

        //dd($disciplines);
        return view('livewire.student-journal', [
            'disciplines' => $paginator,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function showMarks($kafedra)
    {
        $this->emit('showMarks', $kafedra);
    }


}
