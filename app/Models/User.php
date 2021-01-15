<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Yajra\Auditable\AuditableWithDeletesTrait;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property string|null $profile_photo_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $phone_number
 * @property string $position
 * @property bool $active
 * @property int|null $department_id
 * @property string|null $date_of_birth
 * @property-read \App\Models\Department|null $department
 * @property-read \App\Models\Journal|null $lessons
 * @property-read string $profile_photo_url
 * @property string $role
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDateOfBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property bool|null $show_phone
 * @property-read User|null $creator
 * @property-read User|null $deleter
 * @property-read string $created_by_name
 * @property-read string $deleted_by_name
 * @property-read string $updated_by_name
 * @property-read int|null $lessons_count
 * @property-read \App\Models\Department|null $moderator_department
 * @property-read User|null $updater
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|User owned()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereShowPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use AuditableWithDeletesTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'position',
        'role',
        'phone',
        'department_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public const ROLES = [
        1 => 'admin',
        2 => 'moderator',
        3 => 'teacher',
        4 => 'laborant',
    ];

    public const ROLENAMES = [
        1 => 'Администратор',
        2 => 'Модератор',
        3 => 'Преподаватель',
        4 => 'Лаборант',
    ];

    public const POSITIONS = [
        1 => 'не указана',
        2 => 'зав. кафедрой',
        3 => 'доцент',
        4 => 'ассистент',
        5 => 'лаборант',
        6 => 'ректор',
        7 => 'проректор',
        8 => 'декан',
        9 => 'зам. декана',
    ];

    /**
     * @return false|int|string
     * @var mixed
     */

    public static function getRoleID($role)
    {
        return array_search($role, self::ROLES);
    }

    /**
     * get DayType of class
     */
    public function getRoleAttribute(): string
    {
        return self::ROLES[ $this->attributes['role'] ];
    }

    public function getRoleName(): string
    {
        return self::ROLENAMES[ $this->attributes['role'] ];
    }

    public static function listRoles($admin): array
    {
        $roles = self::ROLES;

        if(!$admin) {
            unset($roles[1]);
        }
        return $roles;
    }

    /**
     * @return false|int|string
     * @var mixed
     */

    public static function getPositionID($position)
    {
        return array_search($position, self::POSITIONS);
    }

    public function getPositionAttribute(): string
    {
        return self::POSITIONS[ $this->attributes['position'] ];
    }


/*
    public function setPositionAttribute($value)
    {
        $positionID = self::getPositionID($value);
        if ($positionID) {
            $this->attributes['position'] = $positionID;
        }
    }
*/

    function isAdmin(): bool
    {
        return $this->role == 'admin';
    }

    function isNotAdmin(): bool
    {
        return $this->role !== 'admin';
    }

    function isModerator(): bool
    {
        return $this->role == 'moderator' || $this->role == 'admin';
    }

    function isTeacher(): bool
    {
        return $this->role == 'teacher' || $this->role == 'moderator' || $this->role == 'admin';
    }

    function isWorker(): bool
    {
        return $this->role !== 'admin';
    }


    public  function department ()
    {
        return $this->belongsTo(Department::class);
    }

    public  function moderator_department ()
    {
        return $this->hasOne(Department::class);
    }

    public  function lessons ()
    {
        return $this->hasMany(Journal::class);
    }

    public static function search ($search)
    {
        return empty($search) ? static::query()
            : static::where('id', 'like', '%'.$search.'%')
                ->orWhere('name', 'ilike', '%'.$search.'%')
                ->orWhere('email', 'ilike', '%'.$search.'%');
    }
}
