<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;
use App\Models\Student;
use App\Models\Subject;
use App\Models\ExamType;

class ScoreController extends Controller
{
    public function index()
    {
        $scores = Score::with(['student','examType','subject'])->paginate(10);
        return view('scores.index', compact('scores'));
    }

    public function create()
    {
        $students = Student::all();
        $subjects = Subject::all();
        $examTypes = ExamType::all();
        return view('scores.create', compact('students','subjects','examTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'exam_type_id' => 'required|exists:exam_types,id',
            'subject_id' => 'required|exists:subjects,id',
            'score' => 'required|integer|min:0',
            'max_score' => 'nullable|integer|min:0'
        ]);

        Score::create($request->only(['student_id','exam_type_id','subject_id','score','max_score']));
        return redirect()->route('scores.index')->with('success','Score recorded successfully.');
    }

    public function edit(Score $score)
    {
        $students = Student::all();
        $subjects = Subject::all();
        $examTypes = ExamType::all();
        return view('scores.edit', compact('score','students','subjects','examTypes'));
    }

    public function update(Request $request, Score $score)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'exam_type_id' => 'required|exists:exam_types,id',
            'subject_id' => 'required|exists:subjects,id',
            'score' => 'required|integer|min:0',
            'max_score' => 'nullable|integer|min:0'
        ]);

        $score->update($request->only(['student_id','exam_type_id','subject_id','score','max_score']));
        return redirect()->route('scores.index')->with('success','Score updated successfully.');
    }

    public function destroy(Score $score)
    {
        $score->delete();
        return redirect()->route('scores.index')->with('success','Score deleted successfully.');
    }



}

