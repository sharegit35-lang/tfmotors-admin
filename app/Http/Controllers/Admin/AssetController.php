<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Handover;
use App\Models\HandoverItem;

class AssetController extends Controller
{
    // ១. សម្រាប់បង្ហាញទំព័រ បញ្ជីទ្រព្យសម្បត្តិ (Asset List)
    public function index()
    {
        // ទាញយកទិន្នន័យលិខិតប្រគល់ទ្រព្យសម្បត្តិទាំងអស់ (រួមទាំងអីវ៉ាន់ខាងក្នុង) ពី Database
        // តម្រៀបពីថ្មីបំផុតទៅចាស់ (latest)
        $handovers = Handover::with('items')->latest()->get();
        
        return view('admin.assets.index', compact('handovers'));
    }

    // ២. សម្រាប់បង្ហាញទំព័រ បញ្ចូលទ្រព្យសម្បត្តិថ្មី (Add Asset / Form)
    public function create()
    {
        return view('admin.assets.create');
    }

    // ៣. សម្រាប់ទទួលទិន្នន័យពេលចុច Save បញ្ចូល Database
    public function store(Request $request)
    {
        // វគ្គទី១៖ ការពារទិន្នន័យ (Validation) ត្រូវប្រាកដថាបានបំពេញឈ្មោះ និងសាខា
        $request->validate([
            'employee_name' => 'required|string|max:255',
            'branch'        => 'required|string|max:255',
        ]);

        // វគ្គទី២៖ បញ្ចូលទិន្នន័យទៅក្នុងតារាងមេ (handovers)
        $handover = Handover::create([
            'employee_name' => $request->employee_name,
            'position'      => $request->position,
            'branch'        => $request->branch,
            'handover_date' => now(),
            'status'        => 'active',
        ]);

        // វគ្គទី៣៖ រៀបចំទិន្នន័យសម្រាប់តារាងកូន (handover_items)
        $items = [];
        $index = 1;
        
        // Loop ឆែកមើលគ្រប់ Input ដែលបញ្ជូនមកពី Form HTML របស់បង (description_1, description_2, ...)
        while ($request->has("description_$index")) {
            // បើប្រអប់បរិយាយមានសរសេរអក្សរ ទើបយើងយកវា
            if ($request->filled("description_$index")) { 
                $items[] = [
                    'handover_id'   => $handover->id, // ភ្ជាប់លេខ ID ទៅតារាងមេខាងលើ
                    'description'   => $request->input("description_$index"),
                    'serial_number' => $request->input("serial_$index"),
                    'quantity'      => $request->input("quantity_$index", 1), // បើអត់ដាក់ចំនួន គឺយកលេខ 1
                    'asset_code'    => $request->input("code_$index"),
                    'condition'     => $request->input("condition_$index"),
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ];
            }
            $index++;
        }

        // វគ្គទី៤៖ បញ្ចូលទិន្នន័យអីវ៉ាន់ទាំងអស់ទៅក្នុង Database ក្នុងពេលតែមួយ (ដើម្បីលឿន)
        if (!empty($items)) {
            HandoverItem::insert($items);
        }

        // វគ្គទី៥៖ ត្រឡប់ទៅទំព័រដើមវិញ ព្រមទាំងបង្ហាញសារជោគជ័យ
        return redirect()->route('admin.assets.index')->with('success', 'រក្សាទុកលិខិតធានាអះអាងបានជោគជ័យ!');
    }
}