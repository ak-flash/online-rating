<?php

namespace App\Models;

use Database\Seeders\StudentStudyClassSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableWithDeletesTrait;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\StudyClass
 *
 * @property int $id
 * @property int $lesson_id
 * @property string $title
 * @property int $type_id
 * @property string $date
 * @property string $time_start
 * @property string $time_end
 * @property string|null $room
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Student[] $student
 * @property-read int|null $student_count
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass query()
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereLessonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereRoom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereTimeEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereTimeStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $topic_id
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $deleter
 * @property-read string $created_by_name
 * @property-read string $deleted_by_name
 * @property-read string $updated_by_name
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Query\Builder|StudyClass onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass owned()
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereTopicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|StudyClass withTrashed()
 * @method static \Illuminate\Database\Query\Builder|StudyClass withoutTrashed()
 * @property int $journal_id
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereJournalId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Student[] $students
 * @property-read int|null $students_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Journal[] $journal
 * @property-read int|null $journal_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Topic[] $topic
 * @property-read int|null $topic_count
 */
class StudyClass extends Model
{
    use HasFactory;
    use AuditableWithDeletesTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'journal_id',
        'topic_id',
        'topic_id',
        'date',
        'time_start',
        'time_end',
        'room',
    ];

    protected $dates = ['date', 'created_at', 'updated_at'];

    public const TYPES = [
        1 => 'занятие семинарского типа',
        2 => 'практическое занятие',
        3 => 'лабораторное занятие',
        4 => 'ИТОГОВАЯ',
        5 => 'ЗАЧЕТНОЕ занятие',
        6 => 'ЭКЗАМЕН',
    ];

    /**
     * get Type Id of class
     */
    public static function getTypeID($type)
    {
        return array_search($type, self::TYPES);
    }

    /**
     * get Type of class
     */
    public function getTypeAttribute(): string
    {
        return self::TYPES[ $this->attributes['type_id'] ];
    }


    public function journal() {
        return $this->belongsToMany(Journal::class);
    }

    public function topic() {
        return $this->belongsToMany(Topic::class);
    }


    public function students() {
        return $this->belongsToMany(Student::class)
            ->orderBy('last_name')
            ->using(StudentStudyClass::class)
            ->withPivot('id', 'mark1', 'mark2', 'notify', 'attendance', 'updated_at',  'updated_by',  'permission_file_path')
            ->withTimestamps();
    }

}
