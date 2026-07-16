<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Rsvp; 

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
            $paxNumber = 0; 

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

            // ១. Save ទិន្នន័យចូល Database (តារាង rsvps ត្រូវតែមាន id ជា Primary Key & Auto Increment)
            Rsvp::create([
                'guest_name' => $request->guest_name,
                'pax'        => $paxNumber
            ]);

            // ២. បាញ់ទិន្នន័យទៅ Webhook របស់ Make.com
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
            // ចាប់ Error ពិតប្រាកដបង្ហាញលើ UI ដើម្បីងាយស្រួលជួសជុលពេលមានបញ្ហា Server
            return back()->with('error', 'Server Error: ' . $e->getMessage());
        }
    }
    
    // Function សម្រាប់ផ្ទាំង Admin Dashboard 
    public function dashboard()
    {
        $totalGuests = Rsvp::sum('pax'); 
        $comeOne = Rsvp::where('pax', 1)->count();
        $comeTwo = Rsvp::where('pax', 2)->count();
        $cannotCome = Rsvp::where('pax', 0)->count();
        $allRsvps = Rsvp::latest()->get(); 
    
        return view('wedding.dashboard', compact('totalGuests', 'comeOne', 'comeTwo', 'cannotCome', 'allRsvps'));
    }
}