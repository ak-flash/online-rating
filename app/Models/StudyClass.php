<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyClass extends Model
{
    use HasFactory;

    public const TYPES = [
        1 => 'занятие семинарского типа',
        2 => 'практическое занятие',
        3 => 'лабораторное занятие',
        4 => 'ИТОГОВАЯ',
        5 => 'ЗАЧЕТНОЕ занятие',
        6 => 'ЭКЗАМЕН',
    ];

    /**
     * get Type Id of class
     */
    public static function getTypeID($type)
    {
        return array_search($type, self::TYPES);
    }

    /**
     * get Type of class
     */
    public function getTypeAttribute(): string
    {
        return self::TYPES[ $this->attributes['type_id'] ];
    }
}
