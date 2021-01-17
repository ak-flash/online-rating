<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableWithDeletesTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Topic
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Topic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Topic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Topic query()
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $discipline_id
 * @property int $t_number
 * @property string $title
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
 * @method static \Illuminate\Database\Query\Builder|Topic onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Topic owned()
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereDisciplineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereTNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|Topic withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Topic withoutTrashed()
 * @property string|null $tags
 * @method static \Illuminate\Database\Eloquent\Builder|Topic whereTags($value)
 */
class Topic extends Model
{
    use HasFactory;
    use AuditableWithDeletesTrait, SoftDeletes;

    protected $fillable = [
        'discipline_id',
        'title',
        'tags',
        't_number',
    ];

    protected $dates = ['created_at', 'updated_at'];
}
