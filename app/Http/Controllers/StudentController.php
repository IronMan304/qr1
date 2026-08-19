<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Gender;
use App\Models\Course;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $students = Student::with(['gender','course'])->paginate(10);
    return view('students.index', compact('students'));
}

public function create()
{
    $genders = Gender::all();
    $courses = Course::all();
    return view('students.create', compact('genders','courses'));
}

public function store(Request $request)
{
    $request->validate([
        'id_number' => 'required|unique:students',
        'first_name' => 'required',
        'last_name' => 'required',
        'gender_id' => 'required|exists:genders,id',
        'course_id' => 'required|exists:courses,id',
    ]);

    Student::create($request->all());
    return redirect()->route('students.index')->with('success','Student added successfully.');
}

public function edit(Student $student)
{
    $genders = Gender::all();
    $courses = Course::all();
    return view('students.edit', compact('student','genders','courses'));
}

public function update(Request $request, Student $student)
{
    $request->validate([
        'id_number' => 'required|unique:students,id_number,'.$student->id,
        'first_name' => 'required',
        'last_name' => 'required',
        'gender_id' => 'required|exists:genders,id',
        'course_id' => 'required|exists:courses,id',
    ]);

    $student->update($request->all());
    return redirect()->route('students.index')->with('success','Student updated successfully.');
}

public function destroy(Student $student)
{
    $student->delete();
    return redirect()->route('students.index')->with('success','Student deleted successfully.');
}

}
