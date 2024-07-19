<?php

namespace App\Http\Controllers;

use App\Http\Resources\ComputationResource;
use App\Models\Computation;
use Illuminate\Http\Request;

class ComputationController extends Controller
{
    /**
    * Displaying a listing of resource. 
    *
    *  @return\Illuminate\Http\Response
    */
   public function index()
   {
       //Get students
       $computations = Computation::paginate(15);
       //Return collection of students as a resource.
       return ComputationResource::collection($computations);
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
               'subject_code' => 'required|string|max:255',
               'total_score' => 'required',
               'student_id' => 'required',
               
           ]);
       $computation=new Computation();
       $computation->student_id = $request->input('student_id');
       $computation->subject_code = $request->input('subject_code');
       $computation->total_score = $request->input('total_score');
      
       if ($computation->save()) {
           return new ComputationResource($computation);
       }
   }

   public function update(int$id, Request $request)
   {
       $request->validate(
           [
               'subject_code' => 'required|string|max:255',
               'total_score' => 'required',
               'student_id' => 'required',
               
           ]);

       $computation = Computation::findOrFail($id);
       $computation->student_id = $request->input('student_id');
       $computation->subject_code = $request->input('subject_code');
       $computation->total_score = $request->input('total_score');

       if ($computation->save()) {
           return new ComputationResource($computation);
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
       //Get result_sheet
       $computation = Computation::findOrFail($id);
       //Return single result_sheet as a resource
       return new ComputationResource($computation);
   }

   /**
    * Remove the specified resource from the storage.
    *
    *@param int $id
    *@return\Illuminate\Http\Response
    */
       public function destroy($id)
       {
       //Get result_sheet
       $computation = Computation::findOrFail($id);

       if (!$computation->delete()) {
           return new ComputationResource($computation);
       }
   }
}



