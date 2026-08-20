<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamType;

class ExamTypeController extends Controller
{
    public function index()
    {
        $examTypes = ExamType::paginate(10);
        return view('exam_types.index', compact('examTypes'));
    }

    public function create()
    {
        return view('exam_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:exam_types',
            'description' => 'nullable'
        ]);

        ExamType::create($request->only(['name','description']));
        return redirect()->route('exam_types.index')->with('success','Exam type created successfully.');
    }

    public function edit(ExamType $examType)
    {
        return view('exam_types.edit', compact('examType'));
    }

    public function update(Request $request, ExamType $examType)
    {
        $request->validate([
            'name' => 'required|unique:exam_types,name,'.$examType->id,
            'description' => 'nullable'
        ]);

        $examType->update($request->only(['name','description']));
        return redirect()->route('exam_types.index')->with('success','Exam type updated successfully.');
    }

    public function destroy(ExamType $examType)
    {
        $examType->delete();
        return redirect()->route('exam_types.index')->with('success','Exam type deleted successfully.');
    }
}
