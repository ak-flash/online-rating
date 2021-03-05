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
 * @property-read \App\Models\Department $department
 * @property-read \App\Models\Faculty $faculty
 * @property-read string $last_class
 * @property int|null $volgmed_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Topic[] $topics
 * @property-read int|null $topics_count
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereVolgmedId($value)
 */
class Discipline extends Model
{
    use HasFactory;
    use AuditableWithDeletesTrait, SoftDeletes;

    public const LAST_CLASS_TYPES = [
        1 => 'итоговая',
        2 => 'зачётное занятие',
        3 => 'зачёт с оценкой',
        4 => 'экзамен',
    ];

    protected $fillable = [
        'name',
        'short_name',
        'department_id',
        'faculty_id',
        'semester',
        'last_class_id',
        'volgmed_id',
    ];

    public static function getLastClassID($type)
    {
        return array_search($type, self::LAST_CLASS_TYPES);
    }

    /**
     * get Type of last class
     */
    public function getLastClassAttribute(): string
    {
        return self::LAST_CLASS_TYPES[ $this->attributes['last_class_id'] ];
    }

    public  function department()
    {
        return $this->belongsTo(Department::class);
    }

    public  function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public  function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public  function lectures()
    {
        return $this->hasMany(Lecture::class);
    }

    public static function search ($search)
    {
        return empty($search) ? static::query()
            : static::where('name', 'ilike', '%'.$search.'%')
                ->orWhere('short_name', 'ilike', '%'.$search.'%');
    }
}
