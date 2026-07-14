<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeddingController extends Controller
{
    // សម្រាប់បង្ហាញទំព័រមង្គលការ
    public function index()
    {
        return view('wedding.index');
    }

    // សម្រាប់ទទួលទិន្នន័យពេលភ្ញៀវចុច RSVP
    public function rsvp(Request $request)
    {
        // ១. ពិនិត្យទិន្នន័យឱ្យប្រាកដថាភ្ញៀវបានបំពេញ
        $request->validate([
            'guest_name' => 'required|string|max:255',
            'pax'        => 'required|string', // ចាប់យកជម្រើសចំនួនមនុស្ស
        ]);

        try {
            // URL Webhook របស់បងនៅ Make.com
            $webhookUrl = "https://hook.eu1.make.com/rwsy8y7epiyhmr3aflclhjtgxtpkd8jl";

            // បំប្លែងទិន្នន័យ PAX ជាពាក្យពេចន៍សម្រាប់ Telegram
            $paxStatus = "";
            if ($request->pax == '1') {
                $paxStatus = "មកម្នាក់ឯង 🧍";
            } elseif ($request->pax == '2') {
                $paxStatus = "មក ២ នាក់ 👫";
            } else {
                $paxStatus = "មិនអាចចូលរួមបានទេ 🙏";
            }

            // ២. រៀបចំសារ (Message) សម្រាប់ផ្ញើទៅ Telegram
            $message = "🎉 *មានភ្ញៀវបញ្ជាក់ការចូលរួម (RSVP)*\n";
            $message .= "──────────────────\n";
            $message .= "👤 *ឈ្មោះភ្ញៀវ:* " . $request->guest_name . "\n";
            $message .= "🎟 *ស្ថានភាព:* " . $paxStatus . "\n";
            $message .= "──────────────────\n";
            $message .= "មង្គលការ ពេជ្រ & ធីតា 💍";

            // ៣. បាញ់ទិន្នន័យទៅកាន់ Make.com
            Http::withoutVerifying()
                ->timeout(15)
                ->asForm()
                ->post($webhookUrl, [
                    'text'       => $message, // ទិន្នន័យនេះនឹងលោតចេញជាអក្សរក្នុង Telegram
                    'guest_name' => $request->guest_name,
                    'pax'        => $request->pax
                ]);

            // ៤. បញ្ជូនភ្ញៀវត្រឡប់មកវិញ ជាមួយសារជោគជ័យ (SweetAlert)
            return back()->with('success', 'សូមអរគុណ! ការបញ្ជាក់ចូលរួមរបស់អ្នកទទួលបានជោគជ័យ។');

        } catch (\Exception $e) {
            Log::error('Wedding RSVP Error: ' . $e->getMessage());
            return back()->with('error', 'មានបញ្ហាបច្ចេកទេស សូមសាកល្បងម្ដងទៀត។');
        }
    }
}