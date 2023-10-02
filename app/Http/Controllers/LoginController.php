<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Menampilkan formulir login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Melakukan proses login
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // Coba melakukan login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            $request->session()->put('user_email', $request->email);
            $request->session()->put('password', $request->password);

            // Panggil fungsi untuk mendapatkan API token
            //$apiToken = $this->getAPIToken($request->email, $request->password);

            //$apiToken = auth()->user()->createToken('API Token')->accessToken;

            // Simpan API token ke sesi atau tempat lain yang sesuai
            //Session::put('api_token', $apiToken);

            // Jika berhasil, redirect ke home atau rute yang diinginkan
            return redirect()->intended($this->redirectPath());
        }

        // Jika login gagal, kembali ke formulir login dengan pesan kesalahan
        return $this->sendFailedLoginResponse($request);
    }

    // Melakukan logout
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    // create bearer token untuk akses API
    public function getAPIToken($email, $password)
    {
       /* $response = Http::post('localhost:8000/oauth/token', [
            'grant_type' => 'password',
            'client_id' => env('CLIENT_ID'),
            'client_secret' => env('CLIENT_SECRET'),
            'username' => $email,
            'password' => $password,
            'scope' => '',
        ]);

        return $response->json() ?? null;*/

        $response = Http::asForm()
            ->post(config('app.url') . ':8000/oauth/token', [
                'grant_type' => 'password',
                'client_id' => config('services.passport.client_id'),
                'client_secret' => config('services.passport.client_secret'),
                'username' => $email,
                'password' => $password,
                'scope' => '',
            ]);

        return $response->json()['access_token'] ?? null;
    }
}
