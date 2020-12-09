<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\StudyClass
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
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass query()
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereCourseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereDisciplineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereFacultyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereGroupNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereRoom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereTimeEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereTimeStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudyClass whereUserId($value)
 * @mixin \Eloquent
 */
class StudyClass extends Model
{
    use HasFactory;

    public function faculty() {
        return $this->belongsTo('App\Models\Faculty');
    }


}
