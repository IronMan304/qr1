<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Subject;
use App\Models\Course;

class ModuleController extends Controller
{
   public function index()
{
    $modules = Module::with(['course','subjects'])->paginate(10);
    return view('modules.index', compact('modules'));
}


public function create()
{
    $subjects = Subject::all();
    $courses  = Course::all();   // ✅ fetch courses

    return view('modules.create', compact('subjects','courses'));
}


public function store(Request $request)
{
    $request->validate([
        'code' => 'required|unique:modules',
        'name' => 'required',
        'course_id' => 'required|exists:courses,id',   // ✅ validate course
        'subjects' => 'array'
    ]);

    $module = Module::create($request->only(['code','name','course_id'])); // ✅ include course_id
    $module->subjects()->sync($request->subjects);

    return redirect()->route('modules.index')->with('success','Module created successfully.');
}


public function edit(Module $module)
{
    $subjects = Subject::all();
    $courses  = Course::all();   // ✅ fetch courses

    return view('modules.edit', compact('module','subjects','courses'));
}


public function update(Request $request, Module $module)
{
    $request->validate([
        'code' => 'required|unique:modules,code,'.$module->id,
        'name' => 'required',
        'course_id' => 'required|exists:courses,id',   // ✅ validate course
        'subjects' => 'array'
    ]);

    $module->update($request->only(['code','name','course_id'])); // ✅ include course_id
    $module->subjects()->sync($request->subjects);

    return redirect()->route('modules.index')->with('success','Module updated successfully.');
}



    public function destroy(Module $module)
    {
        $module->delete();
        return redirect()->route('modules.index')->with('success','Module deleted successfully.');
    }
}
