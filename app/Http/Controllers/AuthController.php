<?php

namespace App\Http\Controllers;

use App\Models\Pengguna as User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    /**
     * Form login to system
     *
     * @return Response
     */
    public function loginForm()
    {
        return view('auth.login');
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    /**
     * Login to system
     *
     * @param Request $request
     * @return Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'     => 'required',
            'password'     => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if (is_null($user)) {
            $validator = Validator::make([], []);
            $validator->errors()->add('username', 'Username tidak terdaftar');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validator = Validator::make($request->all(), [
            'password'    => [
                function ($attribute, $value, $fail) use ($request, $user) {
                    if (!Hash::check($request->password, $user->password)) {
                        $fail('Password yang anda masukkan salah');
                    }
                }
            ]
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        Auth::login($user, $request->filled('remember'));
        // $token = bcrypt($request->username . config('app.key') . $request->password . date('YmdHis'));
        // Pengguna::where('tblpengguna_id', Auth::id())->update([
        //     'api_token' => $token,
        // ]);

        // JWT LOGIN
        // $token = Auth::guard('api')->login($user);
        // return redirect()->route('dashboard')->with('apiToken', $token);
        return redirect()->route('home');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email'     => 'required',
            'phone_number'  => 'required',
            'password'     => 'required',
        ]);
        $input = $request->all();
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone_number' => $input['phone_number'],
            'password' => Hash::make($input['password']),
        ]);
        $this->login($user);
        return redirect()->route('home')->with('apiToken', $token);
    }

    /**
     * Logout from system
     *
     * @return Response
     */
    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect('/');
        }
        return redirect('');
    }
}
