<?php

namespace App\Http\Livewire;

use App\Models\Student;
use App\Models\User;
use Livewire\Component;

class StudentMarks extends Component
{
    public $lesson;
    public $rating;

    public function render()
    {

        // Collect all classes
        //$marks = Lesson::with('student')->get();
        $lessons = Student::find($this->lesson['student_id'])
            ->lesson($this->lesson['team_id'])->getResults();


        //dd($this->getTeacherName($classes));
        return view('livewire.student-marks', [ 'lessons' => $this->getClassInfo($lessons)]);
    }

    public function getClassInfo($classes){
        $edited_by = [];
        $marks = [];
        $rating = 0;

        $last_index = (count($classes) - 1);

        foreach ($classes as $class) {
            $edited_by_users[] = $class->pivot->user_id;
            if($class->pivot->mark1!=0) $marks[] = $class->pivot->mark1;
            if($class->pivot->mark2!=0) $marks[] = $class->pivot->mark2;
        }

        if(!empty($edited_by_users)){
            $edited_by = User::select(['id', 'name'])
                ->find(array_unique($edited_by_users));
            $edited_by = $edited_by->pluck('name', 'id');
        }

        if($marks){
            $rating = array_sum($marks) / count($marks);
        }

        $classes->edited_by = $edited_by;
        $classes[$last_index]->rating = round($rating, 1);

        $this->rating = $classes[$last_index]->rating;

        return $classes;
    }


    public function getShortName($name): string
    {
        $name = explode(' ', $name);

        $last_name = $name[0];
        $first_name = mb_substr($name[1], 0,1);
        $middle_name = mb_substr($name[2], 0,1);

        return $last_name.' '.$first_name.'. '.$middle_name.'.';
    }


    public function lessonCleared($attendance, $mark1, $mark2)
    {
        $cleared = false;

        if($attendance || $mark1!=0 || $mark2!=0){
            $cleared = true;
        }

        return $cleared;
    }

}
