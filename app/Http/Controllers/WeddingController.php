<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
            $webhookUrl = "https://hook.eu1.make.com/rwsy8y7epiyhmr3aflclhjtgxtpkd8jl";

            $paxStatus = "";
            if ($request->pax == '1') {
                $paxStatus = "មកម្នាក់ឯង 🧍";
            } elseif ($request->pax == '2') {
                $paxStatus = "មក ២ នាក់ 👫";
            } else {
                $paxStatus = "មិនអាចចូលរួមបានទេ 🙏";
            }

            // រៀបចំសារឱ្យស្អាត (ជៀសវាងសញ្ញាស្មុគស្មាញ)
            $message = "🎉 *មានភ្ញៀវបញ្ជាក់ការចូលរួម (RSVP)*\n\n";
            $message .= "👤 *ឈ្មោះ:* " . $request->guest_name . "\n";
            $message .= "🎟 *ស្ថានភាព:* " . $paxStatus . "\n\n";
            $message .= "មង្គលការ ពេជ្រ & ធីតា 💍";

            // បាញ់ទិន្នន័យទៅ Make.com
            // ប្រើ json() ជំនួស asForm() ពេលខ្លះ Make.com ងាយស្រួលអានទិន្នន័យជាង
            Http::withoutVerifying()
                ->timeout(15)
                ->post($webhookUrl, [
                    'text' => $message
                ]);

            return back()->with('success', 'សូមអរគុណ! ការបញ្ជាក់ចូលរួមរបស់អ្នកទទួលបានជោគជ័យ។');

        } catch (\Exception $e) {
            Log::error('Wedding RSVP Error: ' . $e->getMessage());
            return back()->with('error', 'មានបញ្ហាបច្ចេកទេស សូមសាកល្បងម្ដងទៀត។');
        }
    }
}