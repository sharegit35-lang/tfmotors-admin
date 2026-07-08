<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use Illuminate\Http\Request;

class JobPostController extends Controller
{
    // ១. បង្ហាញបញ្ជីការងារទាំងអស់ (ទំព័រ Index)
    public function index()
    {
        // ទាញទិន្នន័យពីថ្មីទៅចាស់ (Latest)
        $jobs = JobPost::latest()->paginate(10); 
        return view('admin.jobs.index', compact('jobs'));
    }

    // ២. បង្ហាញផ្ទាំងបង្កើតការងារថ្មី (ទំព័រ Create)
    public function create()
    {
        return view('admin.jobs.create');
    }

    // ៣. រក្សាទុកការងារថ្មីចូល Database (Store)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'employment_type' => 'required|string',
            'location' => 'required|string',
            'salary_range' => 'nullable|string',
            'status' => 'required|string',
            'description' => 'required|string',
            'is_urgent' => 'boolean'
        ]);

        JobPost::create($validated);

        return redirect()->route('admin.jobs.index')->with('success', 'ការងារថ្មីត្រូវបានប្រកាសដោយជោគជ័យ!');
    }

    // ៤. ⚡️ បង្ហាញផ្ទាំងកែប្រែ (ទំព័រ Edit - នេះជាកន្លែងដែលបង Error មិញនេះ)
    public function edit($id)
    {
        $job = JobPost::findOrFail($id);
        return view('admin.jobs.edit', compact('job'));
    }

    // ៥. ⚡️ រក្សាទុកទិន្នន័យដែលបានកែប្រែ (Update)
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'employment_type' => 'required|string',
            'location' => 'required|string',
            'salary_range' => 'nullable|string',
            'status' => 'required|string',
            'description' => 'required|string',
            'is_urgent' => 'boolean'
        ]);

        $job = JobPost::findOrFail($id);
        
        // ប្រសិនបើកូដអត់បានបញ្ជូន is_urgent មក (មានន័យថាគេបិទ) ត្រូវកំណត់វាទៅជា false/0
        $validated['is_urgent'] = $request->has('is_urgent') ? $request->is_urgent : 0;
        
        $job->update($validated);

        return redirect()->route('admin.jobs.index')->with('success', 'ព័ត៌មានការងារត្រូវបានកែប្រែដោយជោគជ័យ!');
    }

    // ៦. ⚡️ លុបការងារចោល (Destroy)
    public function destroy($id)
    {
        $job = JobPost::findOrFail($id);
        $job->delete();

        return back()->with('success', 'ការងារត្រូវបានលុបចេញពីប្រព័ន្ធរួចរាល់!');
    }

    // ៧. បិទ/បើក ស្ថានភាព (Open/Closed)
    public function toggleStatus($id)
    {
        $job = JobPost::findOrFail($id);
        $job->status = $job->status === 'Open' ? 'Closed' : 'Open';
        $job->save();
        
        return back()->with('success', 'ស្ថានភាពការងារត្រូវបានផ្លាស់ប្តូរជោគជ័យ!');
    }

    // ៨. បិទ/បើក ភាពបន្ទាន់ (Urgent)
    public function toggleUrgent($id)
    {
        $job = JobPost::findOrFail($id);
        $job->is_urgent = !$job->is_urgent;
        $job->save();
        
        return back()->with('success', 'កំណត់ភាពបន្ទាន់រួចរាល់!');
    }
    public function dashboard()
    {
        // រាប់ចំនួនការងារសរុប និងចំនួនអ្នកដាក់ពាក្យ (ប្រសិនបើបងមាន Model Applicants)
        $totalJobs = \App\Models\JobPost::count();
        $urgentJobs = \App\Models\JobPost::where('is_urgent', true)->count();
        $openJobs = \App\Models\JobPost::where('status', 'Open')->count();
        
        // បង្ហាញ Chart ដោយរាប់តាមប្រភេទការងារ
        $jobsByType = \App\Models\JobPost::select('employment_type', \DB::raw('count(*) as total'))
            ->groupBy('employment_type')
            ->pluck('total', 'employment_type');
    
        return view('admin.dashboard', compact('totalJobs', 'urgentJobs', 'openJobs', 'jobsByType'));
    }

}