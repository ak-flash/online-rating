<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Yajra\Auditable\AuditableWithDeletesTrait;

/**
 * App\Models\StudentStudyClass
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
 * @method static \Illuminate\Database\Eloquent\Builder|StudentStudyClass newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentStudyClass newQuery()
 * @method static \Illuminate\Database\Query\Builder|StudentStudyClass onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentStudyClass owned()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentStudyClass query()
 * @method static \Illuminate\Database\Eloquent\Builder|StudentStudyClass whereAttendance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentStudyClass whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentStudyClass whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentStudyClass whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentStudyClass whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentStudyClass whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentStudyClass whereMark1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentStudyClass whereMark2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentStudyClass whereNotify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentStudyClass wherePermissionFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentStudyClass whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentStudyClass whereStudyClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentStudyClass whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentStudyClass whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StudentStudyClass whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|StudentStudyClass withTrashed()
 * @method static \Illuminate\Database\Query\Builder|StudentStudyClass withoutTrashed()
 * @mixin \Eloquent
 */
class StudentStudyClass extends Pivot
{
    use HasFactory;
    use AuditableWithDeletesTrait, SoftDeletes;

    protected $dates = ['created_at', 'updated_at'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'student_study_class';

    public function editedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
