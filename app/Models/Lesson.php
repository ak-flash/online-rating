<?php

namespace App\Models;

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

    protected $dates = ['date', 'created_at', 'updated_at'];

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

    public const TYPES = [
        1 => 'занятие семинарского типа',
        2 => 'практическое занятие',
        3 => 'лабораторное занятие',
        4 => 'ИТОГОВАЯ',
        5 => 'ЗАЧЕТНОЕ занятие',
        6 => 'ЭКЗАМЕН',
    ];

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
        return self::DAYTYPES[ $this->attributes['day_type'] ];
    }

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
        return self::TYPES[ $this->attributes['type'] ];
    }

    /**
     * set DayType to class
     * @param $value
     */
    public function setDayTypeAttribute($value)
    {
        $day_typeID = self::getDayTypeID($value);
        if ($day_typeID) {
            $this->attributes['day_type'] = $day_typeID;
        }
    }

    public function faculty() {
        return $this->belongsTo(Faculty::class);
    }

    public function team() {
        return $this->belongsTo(Team::class)->orderBy('name');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function student()
    {
        return $this->belongsToMany(Student::class);
    }



    public static function findByStudentsGroup($faculty_id, $course_number, $group_number) {
        return static::where('faculty_id', $faculty_id)
            ->where('course_number', $course_number)
            ->where('group_number', $group_number);
    }

}
