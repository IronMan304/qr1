<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TopicAssessment;
use App\Models\Student;
use App\Models\Subject;

class TopicAssessmentController extends Controller
{
public function index() {
    $assessments = TopicAssessment::with(['student','subject'])->paginate(10);
    return view('topic_assessments.index', compact('assessments'));
}

public function create() {
    $students = Student::all();
    $subjects = Subject::all();
    return view('topic_assessments.create', compact('students','subjects'));
}

public function store(Request $request) {
    $request->validate([
        'student_id'=>'required|exists:students,id',
        'subject_id'=>'required|exists:subjects,id',
        'weight'=>'nullable|numeric',
        'grade'=>'nullable|numeric',
        'points'=>'nullable|numeric',
    ]);
    TopicAssessment::create($request->all());
    return redirect()->route('topic_assessments.index')->with('success','Topic Assessment saved.');
}

public function edit(TopicAssessment $topicAssessment) {
    $students = Student::all();
    $subjects = Subject::all();
    return view('topic_assessments.edit', compact('topicAssessment','students','subjects'));
}

public function update(Request $request, TopicAssessment $topicAssessment) {
    $request->validate([
        'student_id'=>'required|exists:students,id',
        'subject_id'=>'required|exists:subjects,id',
        'weight'=>'nullable|numeric',
        'grade'=>'nullable|numeric',
        'points'=>'nullable|numeric',
    ]);
    $topicAssessment->update($request->all());
    return redirect()->route('topic_assessments.index')->with('success','Topic Assessment updated.');
}

public function destroy(TopicAssessment $topicAssessment) {
    $topicAssessment->delete();
    return redirect()->route('topic_assessments.index')->with('success','Topic Assessment deleted.');
}

}
