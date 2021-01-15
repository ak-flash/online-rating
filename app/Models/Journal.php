<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableWithDeletesTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Journal
 *
 * @property int $id
 * @property int $user_id
 * @property int $department_id
 * @property int $discipline_id
 * @property string $time_start
 * @property string $time_end
 * @property int $day_type_id
 * @property int $faculty_id
 * @property string $year
 * @property int|null $semester
 * @property int|null $course_number
 * @property int|null $group_number
 * @property string|null $room
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Department $department
 * @property-read \App\Models\Discipline $discipline
 * @property-read \App\Models\Faculty $faculty
 * @property string $day_type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\StudyClass[] $study_classes
 * @property-read int|null $study_classes_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Journal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Journal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Journal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereCourseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereDayTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereDisciplineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereFacultyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereGroupNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereRoom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereSemester($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereTimeEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereTimeStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereYear($value)
 * @mixin \Eloquent
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
 * @method static \Illuminate\Database\Query\Builder|Journal onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Journal owned()
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Journal whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|Journal withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Journal withoutTrashed()
 */
class Journal extends Model
{
    use HasFactory;
    use AuditableWithDeletesTrait, SoftDeletes;

    protected $fillable = [
        'discipline_id',
        'group_number',
        'time_start',
        'time_end',
        'day_type_id',
        'user_id',
        'department_id',
        'faculty_id',
        'semester',
        'year',
        'room',
        'course_number',
    ];

    protected $dates = ['created_at', 'updated_at'];

    public const RATING_TABLE = [
        '2' => '0',
        '3' => '61',
        '3.1' => '62',
        '3.2' => '64',
        '3.3' => '65',
        '3.4' => '66',
    ];

    public const DAYTYPES = [
        1 => 'oddweek',
        2 => 'evenweek',
        3 => 'everyweek',
        4 => 'cycle'
    ];

    public const DAYTYPESRUS = [
        1 => 'еженедельно',
        2 => 'чётная неделя',
        3 => 'нечётная неделя',
        4 => 'цикл'
    ];

    public const DATESEMESTERS = [
        'start_autumn' => '-09-01',
        'end_autumn' => '-01-31',
        'start_spring' => '-02-01',
        'end_spring' => '-08-31',
    ];


    public const SEMESTERS = [
        'autumn' => [1, 3, 5, 7, 9, 11],
        'spring' => [2, 4, 6, 8, 10, 12],
    ];

    public static function getStudyYear($date)
    {
        $check_date = Carbon::parse($date);
        $study_year = $check_date->format('Y');
        $study_months = $check_date->format('n');

        // Check if date between February and August (spring term)
        if($study_months>=2&&$study_months<=8) {
            return $study_year;
        }

        return ($study_year-1);
    }

    public static function getSemesterType($date): string
    {
        $check_date = Carbon::parse($date);

        $study_months = $check_date->format('n');

        // Check if date between February and August (spring term)
        if($study_months>=2&&$study_months<=8) {
            return 'spring';
        }

        return 'autumn';
    }

    /**
     * get Day Id of class
     * @param $type
     * @return mixed
     */
    public static function getDayTypeID($type)
    {
        return array_search($type, self::DAYTYPES);
    }

    /**
     * get DayType of class
     */
    public function getDayTypeAttribute(): string
    {
        return self::DAYTYPES[ $this->attributes['day_type_id'] ];
    }

    public function getDayTypeRus(): string
    {
        return self::DAYTYPESRUS[ $this->attributes['day_type_id'] ];
    }
    /**
     * set DayType to class
     * @param $value
     */
    public function setDayTypeAttribute($value)
    {
        $day_typeID = self::getDayTypeID($value);
        if ($day_typeID) {
            $this->attributes['day_type_id'] = $day_typeID;
        }
    }

    public function faculty() {
        return $this->belongsTo(Faculty::class);
    }

    public function department() {
        return $this->belongsTo(Department::class)->orderBy('name');
    }

    public function discipline() {
        return $this->belongsTo(Discipline::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function study_classes() {
        return $this->hasMany(StudyClass::class);
    }



    public static function findByStudentsGroup($faculty_id, $course_number, $group_number) {
        return static::where('faculty_id', $faculty_id)
            ->where('course_number', $course_number)
            ->where('group_number', $group_number);
    }

}
