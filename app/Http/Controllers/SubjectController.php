<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubjectResource;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get subjects
        $subjects = Subject::paginate(15);
        // Return collection of subjects as a resource
        return SubjectResource::collection($subjects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject_name' => 'required|string|max:255',
            'subject_code' => 'required',
        ]);

        $subject = new Subject();
        $subject->subject_name = $request->input('subject_name');
        $subject->subject_code = $request->input('subject_code');

        if ($subject->save()) {
            return new SubjectResource($subject);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'subject_name' => 'required|string|max:255',
            'subject_code' => 'required',
        ]);

        $subject = Subject::findOrFail($id);
        $subject->subject_name = $request->input('subject_name');
        $subject->subject_code = $request->input('subject_code');

        if ($subject->save()) {
            return new SubjectResource($subject);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get subject 
        $subject = Subject::findOrFail($id);
        // Return single subject as a resource
        return new SubjectResource($subject);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Get subject 
        $subject = Subject::findOrFail($id);

        if ($subject->delete()) {
            return new SubjectResource($subject);
        }
    }
}
