<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Handover;
use App\Models\HandoverItem;
use App\Models\Employee; // សន្មតថាបងប្រើ Model User សម្រាប់បុគ្គលិក

class AssetController extends Controller
{
    // ១. ទំព័រ បញ្ជីទ្រព្យសម្បត្តិ
    public function index()
    {
        $handovers = Handover::with('items')->latest()->get();
        return view('admin.assets.index', compact('handovers'));
    }

    // ២. ទំព័រ បញ្ចូលថ្មី (Create)
    public function create()
    {
        $employees = Employee::all(); // 👈 កែត្រង់នេះ
        return view('admin.assets.create', compact('employees'));
    }

    // ៣. មុខងារ រក្សាទុកចូល Database (Store)
    public function store(Request $request)
    {
        $request->validate([
            'employee_name' => 'required|string|max:255',
            'branch'        => 'required|string|max:255',
        ]);

        $handover = Handover::create([
            'employee_name' => $request->employee_name,
            'position'      => $request->position,
            'branch'        => $request->branch,
            'handover_date' => now(),
            'status'        => 'active',
        ]);

        $this->saveItems($request, $handover->id);

        return redirect()->route('admin.assets.index')->with('success', 'រក្សាទុកលិខិតថ្មីបានជោគជ័យ!');
    }
    public function show($id)
    {
        $handover = Handover::with('items')->findOrFail($id);
        // វានឹងហៅ File show.blade.php មកបង្ហាញ
        return view('admin.assets.show', compact('handover'));
    }
    // ៤. ទំព័រ កែប្រែទិន្នន័យ (Edit)
    public function edit($id)
    {
        $handover = Handover::with('items')->findOrFail($id);
        $employees = Employee::all(); // 👈 និងកែត្រង់នេះ
        return view('admin.assets.edit', compact('handover', 'employees'));
    }

    // ៥. មុខងារ រក្សាទុកការកែប្រែ (Update)
    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_name' => 'required|string|max:255',
            'branch'        => 'required|string|max:255',
        ]);

        $handover = Handover::findOrFail($id);
        
        // Update តារាងមេ
        $handover->update([
            'employee_name' => $request->employee_name,
            'position'      => $request->position,
            'branch'        => $request->branch,
        ]);

        // លុបអីវ៉ាន់ចាស់ៗចោលទាំងអស់ រួចបញ្ចូលថ្មី (ដើម្បីងាយស្រួលគ្រប់គ្រង Dynamic Form)
        $handover->items()->delete();
        $this->saveItems($request, $handover->id);

        return redirect()->route('admin.assets.index')->with('success', 'កែប្រែព័ត៌មានលិខិតបានជោគជ័យ!');
    }

    // ៦. មុខងារ លុប (Destroy)
    public function destroy($id)
    {
        Handover::findOrFail($id)->delete();
        return redirect()->route('admin.assets.index')->with('success', 'លុបលិខិតបានជោគជ័យ!');
    }

    // --- Function ជំនួយសម្រាប់ Loop បញ្ចូលទិន្នន័យអីវ៉ាន់ ---
    private function saveItems($request, $handover_id)
    {
        $items = [];
        $index = 1;
        while ($request->has("description_$index")) {
            if ($request->filled("description_$index")) { 
                $items[] = [
                    'handover_id'   => $handover_id,
                    'description'   => $request->input("description_$index"),
                    'serial_number' => $request->input("serial_$index"),
                    'quantity'      => $request->input("quantity_$index", 1),
                    'asset_code'    => $request->input("code_$index"),
                    'condition'     => $request->input("condition_$index"),
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ];
            }
            $index++;
        }
        if (!empty($items)) { HandoverItem::insert($items); }
    }
}