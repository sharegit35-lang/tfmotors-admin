<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Rsvp; // កុំភ្លេចហៅ Model មកប្រើនៅត្រង់នេះ

class WeddingController extends Controller
{
    public function index()
    {
        return view('wedding.index');
    }

    public function rsvp(Request $request)
    {
        $request->validate([
            'guest_name' => 'required|string|max:255',
            'pax'        => 'required|string',
        ]);

        try {
            $webhookUrl = "https://hook.eu1.make.com/ybp08rordxinf5ywqthjsvc1vdyy0mqu";

            $paxStatus = "";
            $paxNumber = 0; // បង្កើតអថេរនេះសម្រាប់ Save លេខចូល Database ងាយស្រួលបូកសរុប

            if ($request->pax == '1') {
                $paxStatus = "មកម្នាក់ឯង 🧍";
                $paxNumber = 1;
            } elseif ($request->pax == '2') {
                $paxStatus = "មក ២ នាក់ 👫";
                $paxNumber = 2;
            } else {
                $paxStatus = "មិនអាចចូលរួមបានទេ 🙏";
                $paxNumber = 0;
            }

            $message = "🎉 *មានភ្ញៀវបញ្ជាក់ការចូលរួម (RSVP)*\n\n";
            $message .= "👤 *ឈ្មោះ:* " . $request->guest_name . "\n";
            $message .= "🎟 *ស្ថានភាព:* " . $paxStatus . "\n\n";
            $message .= "មង្គលការ ពេជ្រ & ធីតា 💍";

            // ១. រក្សាទុកទិន្នន័យចូលក្នុង Database សិន
            Rsvp::create([
                'guest_name' => $request->guest_name,
                'pax'        => $paxNumber
            ]);

            // ២. បាញ់ទិន្នន័យទៅ Make.com ជាទម្រង់ Form (Telegram Notification)
            Http::withoutVerifying()
                ->asForm() 
                ->timeout(15)
                ->post($webhookUrl, [
                    'guest_name' => $request->guest_name,
                    'pax_status' => $paxStatus,
                    'text'       => $message
                ]);

            return back()->with('success', 'សូមអរគុណ!');

        } catch (\Exception $e) {
            Log::error('Wedding RSVP Error: ' . $e->getMessage());
            return back()->with('error', 'មានបញ្ហា។');
        }
    }
    
    // (ជម្រើស) Function សម្រាប់ទំព័រ Admin Dashboard ទុកមើលចំនួនសរុប
    public function dashboard()
    {
        // ១. សរុបចំនួនភ្ញៀវដែលនឹងមកផ្ទាល់ (បូកចំនួន pax ទាំងអស់)
        $totalGuests = Rsvp::sum('pax'); 
        
        // ២. រាប់ចំនួនសំបុត្រ/អ្នកដែលបានចុះឈ្មោះ តាមប្រភេទនីមួយៗ
        $comeOne = Rsvp::where('pax', 1)->count();
        $comeTwo = Rsvp::where('pax', 2)->count();
        $cannotCome = Rsvp::where('pax', 0)->count();

        // ៣. ទាញទិន្នន័យបញ្ជីឈ្មោះភ្ញៀវទាំងអស់មកបង្ហាញ (ពីថ្មីទៅចាស់)
        $allRsvps = Rsvp::latest()->get(); 
    
        // បោះទិន្នន័យទាំងអស់នេះទៅកាន់ទំព័រ UI
        return view('wedding.dashboard', compact('totalGuests', 'comeOne', 'comeTwo', 'cannotCome', 'allRsvps'));
    }
}
