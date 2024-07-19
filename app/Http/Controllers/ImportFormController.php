<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImportFormController extends Controller
{
    public function showForm()
    {
        return view('import-Form');
    }

}