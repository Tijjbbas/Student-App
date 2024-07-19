<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentImport implements ToModel,WithValidation,WithHeadingRow

{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'name'=> $row['name'],
            'phone_number'=>$row['phone_number'],
            'email_address'=>$row['email_address'],
            'class'=>$row['class'],
            'entry_year'=>$row['entry_year'],
            'religion'=>$row['religion'],
            'sex'=>$row['sex'],
            'age'=>$row['age']
        ]);
    }

              public function rules(): array

            {
                return[
                    'email_address'=>'required|unique:students,email_address'
                ];

            }
        }
    