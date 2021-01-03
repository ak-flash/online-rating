<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $position
 * @property string|null $role
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $remember_token
 * @property int|null $department_id
 * @property string|null $profile_photo_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Team|null $currentTeam
 * @property-read string $profile_photo_url
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Team[] $ownedTeams
 * @property-read int|null $owned_teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Team[] $teams
 * @property-read int|null $teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'position_id',
        'role_id',
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
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    public const ROLES = [
        1 => 'admin',
        2 => 'moderator',
        3 => 'teacher',
        4 => 'laborant',
    ];

    public const ROLESRUS = [
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
        return self::ROLES[ $this->attributes['role_id'] ];
    }

    public function getRoleRus(): string
    {
        return self::ROLESRUS[ $this->attributes['role_id'] ];
    }

    /**
     * set Role to class
     * @param $value
     */
    public function setRoleAttribute($value)
    {
        $roleID = self::getRoleID($value);
        if ($roleID) {
            $this->attributes['role_id'] = $roleID;
        }
    }

    public static function getPositionID($position)
    {
        return array_search($position, self::POSITIONS);
    }

    public function getPosition(): string
    {
        return self::POSITIONS[$this->attributes['position_id']];
    }

    public static function getPositionName($position): string
    {
        return self::POSITIONS[$position];
    }

    function isAdmin(): bool
    {
        return $this->role == 'admin';
    }

    function isModerator(): bool
    {
        return $this->role == 'moderator' || $this->role == 'admin';
    }

    function isTeacher(): bool
    {
        return $this->role == 'teacher' || $this->role == 'moderator' || $this->role == 'admin';
    }



    public  function department() {
        return $this->belongsTo(Department::class);
    }


    public static function search($search){
        return empty($search) ? static::query()
            : static::where('id', 'like', '%'.$search.'%')
                ->orWhere('name', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%');
    }

    /**
     * Get the URL to the user's profile photo.
     *
     * @return string
     */
    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo_path
            ? Storage::disk($this->profilePhotoDisk())->url($this->profile_photo_path)
            : $this->defaultProfilePhotoUrl();
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultProfilePhotoUrl()
    {
        $user_name = explode(' ', $this->name);
        return 'https://ui-avatars.com/api/?name='.urlencode($user_name[1].' '.$user_name[0]).'&color=bedebf&background=43a047';
    }

    /**
     * Get the disk that profile photos should be stored on.
     *
     * @return string
     */
    protected function profilePhotoDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : 'public';
    }

}
