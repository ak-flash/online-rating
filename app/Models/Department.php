<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Department
 *
 * @property int $id
 * @property int $user_id Moderator Id
 * @property string $name
 * @property string|null $phone
 * @property string|null $adress
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Department newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Department newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Department query()
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereAdress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereUserId($value)
 * @mixin \Eloquent
 * @property string|null $address
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Discipline[] $disciplines
 * @property-read int|null $disciplines_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Faculty[] $faculties
 * @property-read int|null $faculties_count
 * @method static \Illuminate\Database\Eloquent\Builder|Department whereAddress($value)
 */
class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'phone',
    ];

    public  function user ()
    {
        return $this->belongsTo(User::class);
    }

    public  function disciplines()
    {
        return $this->hasMany(Discipline::class)->orderBy('name');
    }

    public  function faculties()
    {
        return $this->hasMany(Faculty::class);
    }


    public static function search ($search)
    {
        return empty($search) ? static::query()
            : static::where('id', 'like', '%'.$search.'%')
                ->orWhere('name', 'like', '%'.$search.'%');
    }
}
