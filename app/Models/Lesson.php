<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Lesson
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $team_id
 * @property int|null $discipline_id
 * @property string $date
 * @property string $time_start
 * @property string $time_end
 * @property int|null $faculty_id
 * @property int|null $course_number
 * @property int|null $group_number
 * @property string|null $room
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Faculty|null $faculty
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereCourseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereDisciplineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereFacultyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereGroupNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereRoom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereTimeEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereTimeStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereUserId($value)
 * @mixin \Eloquent
 */
class Lesson extends Model
{
    use HasFactory;

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
        1 => 'нечётная неделя',
        2 => 'чётная неделя',
        3 => 'еженедельно',
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

    public static function getSemester($date, $study_year) {

        $check_date = Carbon::parse($date);

        $startDate_autumn = Carbon::parse($study_year.self::DATESEMESTERS['start_autumn']);

        $endDate_autumn = Carbon::parse(($study_year + 1).self::DATESEMESTERS['end_autumn']);

        $startDate_spring = Carbon::parse(($study_year + 1).self::DATESEMESTERS['start_spring']);

        $endDate_spring = Carbon::parse(($study_year + 1).self::DATESEMESTERS['end_spring']);


        if($check_date->between($startDate_autumn,$endDate_autumn)){
            return 'autumn';
        }

        if($check_date->between($startDate_spring,$endDate_spring)){
            return 'spring';
        }

        return false;
    }

    /**
     * get Day Id of class
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
