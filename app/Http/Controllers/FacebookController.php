<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FacebookController extends Controller
{
    // ១. មុខងារសម្រាប់ឱ្យ Facebook ផ្ទៀងផ្ទាត់ (Verify) ថា Webhook ដើរពិតប្រាកដ
    public function verifyWebhook(Request $request)
    {
        $verifyToken = "TFCAM_SECURE_123"; // ត្រូវដូចគ្នាជាមួយកូដដែលបងបំពេញក្នុង Facebook

        if ($request->query('hub_mode') === 'subscribe' && $request->query('hub_verify_token') === $verifyToken) {
            return response($request->query('hub_challenge'), 200);
        }

        return response('Verification Failed', 403);
    }

    // ២. មុខងារសម្រាប់ទទួលទិន្នន័យ (យើងដាក់ឱ្យដើរសិន ចាំថែមកូដ Reply តាមក្រោយ)
    public function handleWebhook(Request $request)
    {
        // គ្រាន់តែប្រាប់ Facebook ថា "យើងទទួលបានហើយ" ដើម្បីកុំឱ្យវា Error
        return response('EVENT_RECEIVED', 200);
    }
}