<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\ForgotPasswordOtpMail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class ForgotPasswordController extends Controller
{


    public function index()
    {
        return view('auth.forgot-password');
    }


    public function sendOtp(Request $request)
    {

        $request->validate([

            'email' => 'required|email'

        ]);


        $user = User::where(
            'email',
            $request->email
        )->first();



        if (!$user) {

            return response()->json([

                'message' => 'Email not found.'

            ], 422);
        }



        $otp = random_int(100000, 999999);



        session([

            'forgot_email' => $user->email,

            'forgot_otp' => $otp,

            'forgot_expire' => now()
                ->addMinutes(5)
                ->timestamp

        ]);



        Mail::to($user->email)
            ->send(
                new ForgotPasswordOtpMail($otp)
            );



        return response()->json([

            'message' => 'OTP sent to your Gmail.',

            'expires_at' => session('forgot_expire')

        ]);
    }







    /*
    |--------------------------------------------------------------------------
    | Verify OTP
    |--------------------------------------------------------------------------
    */


    public function verifyOtp(Request $request)
    {


        $request->validate([

            'otp' => 'required|digits:6'

        ]);



        if (!session()->has('forgot_otp')) {

            return response()->json([

                'message' => 'OTP expired.'

            ], 422);
        }





        if (time() > session('forgot_expire')) {


            session()->forget([

                'forgot_otp',

                'forgot_expire'

            ]);



            return response()->json([

                'message' => 'OTP time expired.'

            ], 422);
        }







        if ($request->otp != session('forgot_otp')) {


            return response()->json([

                'message' => 'Invalid OTP.'

            ], 422);
        }







        session([

            'forgot_verified' => true

        ]);





        return response()->json([

            'message' => 'OTP verified successfully.'

        ]);
    }









    /*
    |--------------------------------------------------------------------------
    | Resend OTP
    |--------------------------------------------------------------------------
    */


    public function resendOtp()
    {


        if (!session()->has('forgot_email')) {

            return response()->json([

                'message' => 'Session expired.'

            ], 422);
        }





        // Timer not finished

        if (
            time() < session('forgot_expire')
        ) {


            return response()->json([

                'message' => 'Please wait until timer finishes.'

            ], 422);
        }







        $otp = random_int(
            100000,
            999999
        );




        session([

            'forgot_otp' => $otp,


            'forgot_expire' => now()
                ->addMinutes(5)
                ->timestamp

        ]);






        Mail::to(
            session('forgot_email')
        )
            ->send(
                new ForgotPasswordOtpMail($otp)
            );





        return response()->json([

            'message' => 'New OTP sent.',


            'expires_at' =>
            session('forgot_expire')

        ]);
    }


    public function resetPassword(Request $request)
    {


        $request->validate([


            'password' =>
            'required|min:8|confirmed'


        ]);







        if (
            !session('forgot_verified')
        ) {


            return response()->json([

                'message' => 'OTP verification required.'

            ], 422);
        }







        $user = User::where(

            'email',

            session('forgot_email')

        )->first();







        if (!$user) {

            return response()->json([

                'message' => 'User not found.'

            ], 422);
        }









        $user->update([

            'password' => Hash::make(
                $request->password
            )

        ]);








        session()->forget([


            'forgot_email',

            'forgot_otp',

            'forgot_expire',

            'forgot_verified'


        ]);







        return response()->json([

            'message' => 'Password reset successfully.'

        ]);
    }
}
