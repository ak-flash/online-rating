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
 */
class Discipline extends Model
{
    use HasFactory;
    use AuditableWithDeletesTrait, SoftDeletes;


}
