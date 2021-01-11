<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableWithDeletesTrait;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Discipline
 *
 * @property int $id
 * @property string $name
 * @property string|null $short_name
 * @property int $department_id
 * @property int $faculty_id
 * @property int $semester
 * @property int $last_class_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline query()
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereFacultyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereLastClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereSemester($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereUpdatedAt($value)
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
 * @method static \Illuminate\Database\Query\Builder|Discipline onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline owned()
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|Discipline withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Discipline withoutTrashed()
 */
class Discipline extends Model
{
    use HasFactory;
    use AuditableWithDeletesTrait, SoftDeletes;


}
