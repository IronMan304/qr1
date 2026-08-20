<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Domain;

class DomainController extends Controller
{
    public function index()
    {
        $domains = Domain::paginate(10);
        return view('domains.index', compact('domains'));
    }

    public function create()
    {
        return view('domains.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:domains'
        ]);

        Domain::create($request->only('name'));
        return redirect()->route('domains.index')->with('success','Domain created successfully.');
    }

    public function edit(Domain $domain)
    {
        return view('domains.edit', compact('domain'));
    }

    public function update(Request $request, Domain $domain)
    {
        $request->validate([
            'name' => 'required|unique:domains,name,'.$domain->id
        ]);

        $domain->update($request->only('name'));
        return redirect()->route('domains.index')->with('success','Domain updated successfully.');
    }

    public function destroy(Domain $domain)
    {
        $domain->delete();
        return redirect()->route('domains.index')->with('success','Domain deleted successfully.');
    }
}
