<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yajra\Auditable\AuditableWithDeletesTrait;

/**
 * App\Models\LessonStudent
 *
 * @property int $id
 * @property int $study_class_id
 * @property int $student_id
 * @property int $mark1
 * @property int $mark2
 * @property string|null $notify
 * @property bool $attendance
 * @property int $user_id
 * @property string|null $permission_file_path
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $deleter
 * @property-read string $created_by_name
 * @property-read string $deleted_by_name
 * @property-read string $updated_by_name
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent newQuery()
 * @method static \Illuminate\Database\Query\Builder|LessonStudent onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent owned()
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent query()
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereAttendance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereMark1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereMark2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereNotify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent wherePermissionFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereStudyClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|LessonStudent withTrashed()
 * @method static \Illuminate\Database\Query\Builder|LessonStudent withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Models\User $editedBy
 * @property int $lesson_id
 * @method static \Illuminate\Database\Eloquent\Builder|LessonStudent whereLessonId($value)
 */
class LessonStudent extends Model
{
    use HasFactory;
    use AuditableWithDeletesTrait, SoftDeletes;

    protected $dates = ['created_at', 'updated_at'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lesson_student';


    public function editedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
