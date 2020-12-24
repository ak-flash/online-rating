<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

    public const ROLES = [
        1 => 'admin',
        2 => 'moderator',
        3 => 'teacher',
        4 => 'laborant'
    ];

    public const ROLESRUS = [
        1 => 'Администратор',
        2 => 'Модератор',
        3 => 'Преподаватель',
        4 => 'Лаборант'
    ];

    public const POSITIONS = [
        1 => 'ректор',
        2 => 'проректор',
        3 => 'декан',
        4 => 'зам. декана',
        5 => 'зав. кафедрой',
        6 => 'доцент',
        7 => 'ассистент',
        8 => 'лаборант',
        9 => '......',
    ];

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

    public function getRoleRus(): string
    {
        return self::ROLESRUS[ $this->attributes['role'] ];
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

    public static function getPositionID($position)
    {
        return array_search($position, self::POSITIONS);
    }

    public function getPosition(): string
    {
        return self::POSITIONS[$this->attributes['position']];
    }

    public static function getPositionName($position): string
    {
        return self::POSITIONS[$position];
    }
}
