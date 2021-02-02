<?php

namespace App\Imports;

use App\Models\Student;
use Helper;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class StudentsImport implements ToModel, WithStartRow
{
    private $faculty_id;

    public function  __construct($faculty_id)
    {
        $this->faculty_id= $faculty_id;
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 8;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(isset($row[0])){
            $studentName = '';
            $studentNames = explode(' ', $row[2]);
            for($i = 1;$i<count($studentNames);$i++){
                $studentName .= $studentNames[$i].' ';
            }

            $studentGroup = explode('/', $row[8]);

            $birthDay = explode('-', $row[3]);

            $studentBirthDay = $birthDay[2].'-'.$birthDay[1].'-'.$birthDay[0];

            return new Student([
                'document_id'     => $row[1],
                'name'     => trim($studentName),
                'last_name'    => $studentNames[0],
                'date_of_birth'    => $studentBirthDay,
                'faculty_id'    => $this->faculty_id,
                'course_number'    => $row[7],
                'group_number'    => $studentGroup[0],
                'email'    => $row[21],
                'phone'    => Helper::clearMask($row[22]),
                'password' => Hash::make('11111111'),
            ]);
        }
    }
}
