<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModuleAssessment;
use App\Models\Student;
use App\Models\Module;

class ModuleAssessmentController extends Controller
{
    public function index()
    {
        $assessments = ModuleAssessment::with(['student','module'])->paginate(10);
        return view('module_assessments.index', compact('assessments'));
    }

    public function create()
    {
        $students = Student::all();
        $modules = Module::all();
        return view('module_assessments.create', compact('students','modules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id'=>'required|exists:students,id',
            'module_id'=>'required|exists:modules,id',
            'weight'=>'nullable|numeric',
            'grade'=>'nullable|numeric',
            'points'=>'nullable|numeric',
        ]);

        ModuleAssessment::create($request->all());
        return redirect()->route('module_assessments.index')->with('success','Module Assessment saved.');
    }

    public function edit(ModuleAssessment $moduleAssessment)
    {
        $students = Student::all();
        $modules = Module::all();
        return view('module_assessments.edit', compact('moduleAssessment','students','modules'));
    }

    public function update(Request $request, ModuleAssessment $moduleAssessment)
    {
        $request->validate([
            'student_id'=>'required|exists:students,id',
            'module_id'=>'required|exists:modules,id',
            'weight'=>'nullable|numeric',
            'grade'=>'nullable|numeric',
            'points'=>'nullable|numeric',
        ]);

        $moduleAssessment->update($request->all());
        return redirect()->route('module_assessments.index')->with('success','Module Assessment updated.');
    }

    public function destroy(ModuleAssessment $moduleAssessment)
    {
        $moduleAssessment->delete();
        return redirect()->route('module_assessments.index')->with('success','Module Assessment deleted.');
    }
}


