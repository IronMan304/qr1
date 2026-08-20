<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\Student;
use App\Models\Subject;
use App\Models\AssessmentType;

class EvaluationController extends Controller
{
    public function index()
    {
        $evaluations = Evaluation::with(['student','subject','assessmentType'])->paginate(10);
        return view('evaluations.index', compact('evaluations'));
    }

    public function create()
    {
        $students = Student::all();
        $subjects = Subject::all();
        $assessmentTypes = AssessmentType::all();
        return view('evaluations.create', compact('students','subjects','assessmentTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'assessment_type_id' => 'required|exists:assessment_types,id',
            'weight' => 'nullable|numeric',
            'grade' => 'nullable|numeric',
            'points' => 'nullable|numeric',
        ]);

        Evaluation::create($request->all());
        return redirect()->route('evaluations.index')->with('success','Evaluation saved successfully.');
    }

    public function edit(Evaluation $evaluation)
    {
        $students = Student::all();
        $subjects = Subject::all();
        $assessmentTypes = AssessmentType::all();
        return view('evaluations.edit', compact('evaluation','students','subjects','assessmentTypes'));
    }

    public function update(Request $request, Evaluation $evaluation)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_id' => 'required|exists:subjects,id',
            'assessment_type_id' => 'required|exists:assessment_types,id',
            'weight' => 'nullable|numeric',
            'grade' => 'nullable|numeric',
            'points' => 'nullable|numeric',
        ]);

        $evaluation->update($request->all());
        return redirect()->route('evaluations.index')->with('success','Evaluation updated successfully.');
    }

    public function destroy(Evaluation $evaluation)
    {
        $evaluation->delete();
        return redirect()->route('evaluations.index')->with('success','Evaluation deleted successfully.');
    }
}
