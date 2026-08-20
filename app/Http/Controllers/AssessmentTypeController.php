<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssessmentType;
use App\Models\Domain;

class AssessmentTypeController extends Controller
{
    public function index()
    {
        $assessmentTypes = AssessmentType::with('domain')->paginate(10);
        return view('assessment_types.index', compact('assessmentTypes'));
    }

    public function create()
    {
        $domains = Domain::all();
        return view('assessment_types.create', compact('domains'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'domain_id' => 'required|exists:domains,id',
           // 'weight' => 'required|numeric|min:0'
        ]);

        AssessmentType::create($request->only(['name','domain_id','weight']));
        return redirect()->route('assessment_types.index')->with('success','Assessment Type created successfully.');
    }

    public function edit(AssessmentType $assessmentType)
    {
        $domains = Domain::all();
        return view('assessment_types.edit', compact('assessmentType','domains'));
    }

    public function update(Request $request, AssessmentType $assessmentType)
    {
        $request->validate([
            'name' => 'required',
            'domain_id' => 'required|exists:domains,id',
           // 'weight' => 'required|numeric|min:0'
        ]);

        $assessmentType->update($request->only(['name','domain_id','weight']));
        return redirect()->route('assessment_types.index')->with('success','Assessment Type updated successfully.');
    }

    public function destroy(AssessmentType $assessmentType)
    {
        $assessmentType->delete();
        return redirect()->route('assessment_types.index')->with('success','Assessment Type deleted successfully.');
    }
}
