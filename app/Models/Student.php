<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'phone_number', 'email_address', 'class', 'entyr_year', 'religion', 'sex', 'age', 'photo'];

    public static function getAllStudents()
    {
        $result = DB::table('students')
            ->select('name', 'phone_number', 'email_address', 'class', 'entyr_year', 'religion', 'sex', 'age', 'photo')
            ->get()
            ->toArray();
        return $result;
    }
}
