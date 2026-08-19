<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Subject::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('code', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        if ($request->filled('statusFilter')) {
            $query->where('status', $request->statusFilter);
        }

        $paginated = $query->paginate(10)->withQueryString();

        return view('subjects.index', compact('paginated'))
            ->with('search', $request->search)
            ->with('date', $request->date)
            ->with('statusFilter', $request->statusFilter);
    }

    public function create()
    {
        return view('subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:subjects',
            'name' => 'required',
        ]);

        Subject::create($request->only(['code','name','description']));
        return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
    }

    public function show(Subject $subject)
    {
        return view('subjects.show', compact('subject'));
    }

    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'code' => 'required|unique:subjects,code,' . $subject->id,
            'name' => 'required',
        ]);

        $subject->update($request->only(['code','name','description']));
        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully.');
    }
}
