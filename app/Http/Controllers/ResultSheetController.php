<?php

namespace App\Http\Controllers;

use App\Http\Resources\ResultSheetResource;
use App\Jobs\ImportStudentsJob;
use App\Models\ResultSheet;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Dompdf\Adapter\PDFLib;

class ResultSheetController extends Controller
{
    /**
     * Displaying a listing of resource. 
     *
     *  @return\Illuminate\Http\Response
     */
    public function index()
    {
        //Get students
        $result_sheets = ResultSheet::paginate(15);
        //Return collection of students as a resource.
        return ResultSheetResource::collection($result_sheets);
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
            'test_score' => 'required',
            'exam_score' => 'required',
            'student_id' => 'required',
            'cgpa' => 'required',
        
        ]);

        $result_sheet = new resultsheet();
        $result_sheet->student_id = $request->input('student_id');
        $result_sheet->subject_code = $request->input('subject_code');
        $result_sheet->test_score = $request->input('test_score');
        $result_sheet->exam_score = $request->input('exam_score');
        $result_sheet->total_score = $request->input('test_score') + $request->input('exam_score');
        $result_sheet->cgpa = $request->input('total_scores') / $request->input('total_Subjects');
        $total_scores = $request->input('total_scores');
        $total_subjects = $request->input('total_subjects');
        $result_sheet->cgpa = number_format($total_scores / $total_subjects,2);

        if ($result_sheet->save()) {
            return new ResultSheetResource($result_sheet);
        }
    }

    public function update(int $id, Request $request)
    {
        $request->validate(
            [
                'subject_code' => 'required|string|max:255',
                'test_score' => 'required',
                'exam_score' => 'required',
                'student_id' => 'required',
                'cgpa' => 'required',
        

            ]
        );

        $result_sheet = ResultSheet::findOrFail($id);
        $result_sheet->student_id = $request->input('student_id');
        $result_sheet->subject_code = $request->input('subject_code');
        $result_sheet->test_score = $request->input('test_score');
        $result_sheet->exam_score = $request->input('exam_score');
        $result_sheet->total_score = $request->input('test_score') + $request->input('exam_score');
        $result_sheet->cgpa = $request->input('total_scores') / $request->input('total_Subjects');
        $total_scores = $request->input('total_scores');
        $total_subjects = $request->input('total_subjects');
        $result_sheet->cgpa = number_format($total_scores / $total_subjects,2);

        if ($result_sheet->save()) {
            return new ResultSheetResource($result_sheet);
        }
    }

    public function showResult($studentId)
    {
        $resultSheet = ResultSheet::query()
            ->where('student_id', $studentId)
            ->get();

        return ResultSheetResource::collection($resultSheet);
    }

    public function showcgpa($studentId)
    {
        // Fetch all results for the student
        $resultSheet = ResultSheet::query()
            ->where('student_id', $studentId)
            ->get();

        // Initialize total GPA and subject count
        $totalGPA = 0;
        $totalSubjects = $resultSheet->count();

        // Array to store subject codes and total scores
        $subjects = [];

        // Define a function to calculate GPA from total score
        function calculateGPA($totalScore)
        {
            if ($totalScore >= 90) {
                return 4.0;
            } elseif ($totalScore >= 80) {
                return 3.5;
            } elseif ($totalScore >= 70) {
                return 3.0;
            } elseif ($totalScore >= 60) {
                return 2.5;
            } elseif ($totalScore >= 50) {
                return 2.0;
            } else {
                return 0.0;
            }
        }

        // Calculate total GPA
        foreach ($resultSheet as $result) {
            $totalGPA += calculateGPA($result->total_score);
            $subjects[] = [
                'subject_code' => $result->subject_code,
                'total_score' => $result->total_score
            ];
        }

        // Compute CGPA
        $cgpa = $totalSubjects ? $totalGPA / $totalSubjects : 0;

         // Get student details (assuming there's a Student model and relationship)
         $student = Student::find($studentId);

          // Generate PDF
          $pdf = FacadePdf::loadView('results', [
            'student' => $student,
            'subjects' => $subjects,
            'cgpa' => $cgpa
          ]);

        // Format the student's name for the file name
            $studentName = str_replace(' ', '_', $student->name);
 
        // Save the PDF with the student's name
         return $pdf->download($studentName . '_result.pdf');

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
        $result_sheet = ResultSheet::findOrFail($id);
        //Return single result_sheet as a resource
        return new ResultSheetResource($result_sheet);
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
        $result_sheet = ResultSheet::findOrFail($id);

        if (!$result_sheet->delete()) {
            return new ResultSheetResource($result_sheet);
        }
    }

    public function importStudents()
    {
        ImportStudentsJob::dispatch();

        return response()->json("Import successfully saved");
    }
}
