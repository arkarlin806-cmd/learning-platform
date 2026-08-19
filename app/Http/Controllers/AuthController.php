<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Str;
use Laravel\Socialite\Facades\Socialite;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return redirect()
                ->route('register')
                ->with(
                    'error',
                    'Your account has been banned by the administrator.'
                );
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user);

        return redirect('/home/index');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $client = new \GuzzleHttp\Client([
            'verify' => false,
        ]);

        $googleUser = Socialite::driver('google')
            ->setHttpClient($client)
            ->user();

        $user = User::where('email', $googleUser->email)->first();

        if (!$user) {

            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
                'password' => bcrypt('password')
            ]);
        }

        Auth::login($user);
        if (auth()->user()->role == 2) {
            return redirect('/admin/dashboard');
        }
        return redirect('/home/index');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials, $request->remember)) {

            $request->session()->regenerate();

            $user = Auth::user();

            $today = Carbon::today();
            $yesterday = Carbon::yesterday();

            // First login
            if (is_null($user->last_login_date)) {

                $user->current_streak = 1;
                $user->last_login_date = $today;
            } else {

                $lastLogin = Carbon::parse($user->last_login_date);

                // Already logged in today
                if ($lastLogin->isSameDay($today)) {

                    // Do nothing

                }
                // Logged in yesterday
                elseif ($lastLogin->isSameDay($yesterday)) {

                    $user->current_streak += 1;
                    $user->last_login_date = $today;
                }
                // Missed one or more days
                else {

                    $user->current_streak = 1;
                    $user->last_login_date = $today;
                }
            }

            $user->save();
            if (Auth::user()->status === 'banned') {

                Auth::logout();

                return redirect()
                    ->route('login')
                    ->with(
                        'error',
                        'Your account has been banned by the administrator.'
                    );
            }
            if ($user->role == 1) {
                return redirect('/admin/dashboard');
            } elseif ($user->role == 2) {
                return redirect('/instructor/index');
            } else {
                return redirect('/home/index');
            }
        }


        return redirect()
            ->route('login')
            ->with(
                'error',
                'Worong email or password.'
            );
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }


    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', __($status))
            : back()->withErrors(['email' => __($status)]);
    }
    public function showResetPassword(string $token)
    {
        return view('auth.reset-password', [
            'token' => $token
        ]);
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only(
                'email',
                'password',
                'password_confirmation',
                'token'
            ),

            function ($user, $password) {

                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect('/login')->with('success', 'Password reset successful')
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function privacy()
    {
        return view('auth.privacy');
    }
}
