<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use Illuminate\Http\Request;

class JobPostController extends Controller
{
    public function index() {
        $jobs = JobPost::latest()->get();
        return view('admin.jobs.index', compact('jobs'));
    }

    public function create() {
        return view('admin.jobs.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'employment_type' => 'required|string',
            'location' => 'required|string',
            'status' => 'required|in:Open,Closed,Draft',
            'salary_range' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        JobPost::create($validated);
        return redirect()->route('admin.jobs.index')->with('success', 'ការងារថ្មីត្រូវបានប្រកាសដោយជោគជ័យ!');
    }

    public function destroy($id) {
        JobPost::findOrFail($id)->delete();
        return redirect()->route('admin.jobs.index')->with('success', 'ព័ត៌មានការងារត្រូវបានលុប!');
    }
}