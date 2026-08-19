<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gender;

class GenderController extends Controller
{
    public function index()
    {
        $genders = Gender::paginate(10);
        return view('genders.index', compact('genders'));
    }

    public function create()
    {
        return view('genders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:genders',
        ]);

        Gender::create($request->only('name'));
        return redirect()->route('genders.index')->with('success', 'Gender created successfully.');
    }

    public function show(Gender $gender)
    {
        return view('genders.show', compact('gender'));
    }

    public function edit(Gender $gender)
    {
        return view('genders.edit', compact('gender'));
    }

    public function update(Request $request, Gender $gender)
    {
        $request->validate([
            'name' => 'required|unique:genders,name,' . $gender->id,
        ]);

        $gender->update($request->only('name'));
        return redirect()->route('genders.index')->with('success', 'Gender updated successfully.');
    }

    public function destroy(Gender $gender)
    {
        $gender->delete();
        return redirect()->route('genders.index')->with('success', 'Gender deleted successfully.');
    }
}
