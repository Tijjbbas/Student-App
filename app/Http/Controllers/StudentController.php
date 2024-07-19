<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Exports\StudentExport;
use App\Imports\StudentImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /**
     * Displaying a listing of resource. 
     *
     *  @return\Illuminate\Http\Response
     */
    public function index()
    {
        $data = Student:: all();
        return view('student-list',compact('data'));
    }
        public function showImportForm(){
            return view ('importForm');
        }
        public Function SaveImportFile(Request $request){
            Excel::import(new StudentImport, $request->file('file'));

            return response()->json([
                'message' => 'Uploaded successfully'
            ]);
            
        //Get students
        // $students = Student::paginate(15);
        //Return collection of students as a resource.
        // return StudentResource::collection($students);
    }
    /**
     * store a newly created resouce in storage.
     * 
     * @param\Illuminate\Http\Request $request
     * @return\Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required',
            'age' => 'required',
            'sex' => 'required',
            'date_of_birth' => 'required',
            'entry_year' => 'required',
            'email_address' => 'required',
            'religion' => 'required',
            'phone_number' => 'required|numeric|digits:9',
            'photo' => 'required|mimes:jpg,png'
        ]);


        $student = new Student();

        $filePath = null;

        if ($request->has('photo')) {
            $filePath = $request->file('photo')->store('passports');
        }

        $student->name = $request->input('name');
        $student->class = $request->input('class');
        $student->age = $request->input('age');
        $student->sex = $request->input('sex');
        $student->date_of_birth = $request->input('date_of_birth');
        $student->entry_year = $request->input('entry_year');
        $student->email_address = $request->input('email_address');
        $student->religion = $request->input('religion');
        $student->phone_number = $request->input('phone_number');
        $student->photo = $filePath;



        if ($student->save()) {
            return new StudentResource($student);
        }
    }

    public function update(int $id, Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'class' => 'required',
                'age' => 'required',
                'sex' => 'required',
                'date_of_birth' => 'required',
                'entry_year' => 'required',
                'email_address' => 'required',
                'religion' => 'required',
                'phone_number' => 'required|numeric|digits:9',
                'photo' => 'required|mimes:jpg,png'

            ],

            [
                'email_address.required' => 'We need to know your email address!'

            ]
        );

        $student = Student::findOrFail($id);

        $filePath = null;

        if ($request->has('photo')) {
            $filePath = $request->file('photo')->store('passports');
        }

        $student->name = $request->input('name');
        $student->class = $request->input('class');
        $student->age = $request->input('age');
        $student->sex = $request->input('sex');
        $student->date_of_birth = $request->input('date_of_birth');
        $student->entry_year = $request->input('entry_year');
        $student->email_address = $request->input('email_address');
        $student->religion = $request->input('religion');
        $student->phone_number = $request->input('phone_number');
        $student->photo = $filePath ?? $student->photo;


        if ($student->save()) {
            return new StudentResource($student);
        }
    }

    /**
     * Display the specified resource
     *
     *@param int $id
     *@return\Illuminate\Http\Response
     */
    public function show($id)
    {
        //Get student 
        $student = Student::findOrFail($id);
        //Return single student as a resource
        return new StudentResource($student);
    }

    /**
     * Remove the specified resource from the storage.
     *
     *@param int $id
     *@return\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Get student 
        $student = Student::findOrFail($id);

        if (!$student->delete()) {
            return new StudentResource($student);
        }
    }
}
