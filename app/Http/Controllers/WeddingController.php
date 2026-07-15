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
            $webhookUrl = "https://hook.eu1.make.com/ybp08rordxinf5ywqthjsvc1vdyy0mqu";

            $paxStatus = "";
            if ($request->pax == '1') {
                $paxStatus = "មកម្នាក់ឯង 🧍";
            } elseif ($request->pax == '2') {
                $paxStatus = "មក ២ នាក់ 👫";
            } else {
                $paxStatus = "មិនអាចចូលរួមបានទេ 🙏";
            }

            $message = "🎉 *មានភ្ញៀវបញ្ជាក់ការចូលរួម (RSVP)*\n\n";
            $message .= "👤 *ឈ្មោះ:* " . $request->guest_name . "\n";
            $message .= "🎟 *ស្ថានភាព:* " . $paxStatus . "\n\n";
            $message .= "មង្គលការ ពេជ្រ & ធីតា 💍";

            // កែសម្រួលត្រង់នេះ៖ បាញ់ទិន្នន័យទៅជាដុំៗ ដើម្បីឱ្យ Make.com ស្គាល់អថេរ
            Http::withoutVerifying()
                ->timeout(15)
                ->post($webhookUrl, [
                    'guest_name' => $request->guest_name, // បន្ថែមវាទៅ
                    'pax_status' => $paxStatus,           // បន្ថែមវាទៅ
                    'text'       => $message              // រក្សាទុកដដែល
                ]);

            return back()->with('success', 'សូមអរគុណ!');

        } catch (\Exception $e) {
            Log::error('Wedding RSVP Error: ' . $e->getMessage());
            return back()->with('error', 'មានបញ្ហា។');
        }
    }
}