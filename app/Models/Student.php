<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Student
 *
 * @property int $id
 * @property string $student_id
 * @property string $last_name
 * @property string $first_name
 * @property string|null $middle_name
 * @property int|null $faculty_id
 * @property int|null $course_number
 * @property int|null $group_number
 * @property string $email
 * @property string|null $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Faculty|null $faculty
 * @method static \Illuminate\Database\Eloquent\Builder|Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student query()
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereCourseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereFacultyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereGroupNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Student extends Model
{
    use HasFactory;


    public function faculty() {
        return $this->belongsTo(Faculty::class);
    }



    public function lesson($kafedra_id)
    {
        return $this->belongsToMany(Lesson::class)
            ->where('team_id', $kafedra_id)
            ->withPivot('mark1', 'mark2', 'notify', 'attendance', 'user_id', 'updated_at');
    }

    public static function findStudent($document_id) {
        return Student::firstWhere('document_id', $document_id);
    }

    public function logout() {

        session()->forget('student');

        //dd(session('student_id'));
        return redirect('/');
    }

}
