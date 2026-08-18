<?php

// namespace App\Services;

// use Illuminate\Support\Facades\Http;
// use Illuminate\Support\Facades\Log;

// class BrevoMailService
// {
//     public function send(
//         string $email,
//         string $subject,
//         string $html
//     ): bool {

//         try {

//             $response = Http::timeout(30)
//                 ->withHeaders([
//                     'api-key' => config('services.brevo.key'),
//                     'accept' => 'application/json',
//                     'content-type' => 'application/json',
//                 ])
//                 ->post('https://api.brevo.com/v3/smtp/email', [

//                     'sender' => [
//                         'name' => config('mail.from.name'),
//                         'email' => config('mail.from.address'),
//                     ],

//                     'to' => [
//                         [
//                             'email' => $email,
//                         ],
//                     ],

//                     'subject' => $subject,

//                     'htmlContent' => $html,

//                 ]);


//             if ($response->failed()) {

//                 Log::error('Brevo mail failed', [
//                     'status' => $response->status(),
//                     'response' => $response->json(),
//                 ]);

//                 return false;
//             }


//             return true;
//         } catch (\Throwable $e) {


//             Log::error('Brevo mail exception', [
//                 'error' => $e->getMessage(),
//             ]);


//             return false;
//         }
//     }
// }


namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BrevoMailService
{
    public function send(
        string $email,
        string $subject,
        string $html
    ): bool {

        try {

            $response = Http::timeout(30)
                ->withHeaders([
                    'api-key' => config('services.brevo.key'),
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ])
                ->post('https://api.brevo.com/v3/smtp/email', [

                    'sender' => [
                        'name' => config('mail.from.name'),
                        'email' => config('mail.from.address'),
                    ],

                    'to' => [
                        [
                            'email' => $email,
                        ],
                    ],

                    'subject' => $subject,
                    'htmlContent' => $html,
                ]);

            if ($response->failed()) {

                Log::error('Brevo mail failed', [
                    'email' => $email,
                    'subject' => $subject,
                    'status' => $response->status(),
                    'response' => $response->body(),
                ]);

                return false;
            }

            Log::info('Brevo mail sent successfully', [
                'email' => $email,
                'subject' => $subject,
                'status' => $response->status(),
                'message_id' => $response->json('messageId'),
            ]);

            return true;
        } catch (\Throwable $e) {

            Log::error('Brevo mail exception', [
                'email' => $email,
                'subject' => $subject,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }
}
