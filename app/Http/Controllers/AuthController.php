<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as PasswordRule;

class AuthController extends Controller
{
    public function showLogin() { return view('auth.login'); }
    public function showSignup() { return view('auth.signup'); }
    public function showPasswordReset() { return view('auth.password-reset'); }

    public function login(Request $request)
    {
        $credentials = $request->validate(['email'=>'required|email','password'=>'required|string']);
        $remember = $request->boolean('remember');
        if (!Auth::attempt($credentials, $remember)) {
            return back()->withErrors(['email'=>'The provided credentials are incorrect.'])->withInput();
        }
        $request->session()->regenerate();
        return redirect()->intended(route('home'))->with('success','Welcome back!');
    }

    public function signup(Request $request)
    {
        $data = $request->validate([
            'email'=>'required|email|unique:users,email',
            'password'=>['required','confirmed',PasswordRule::min(8)],
            'first_name'=>'required|string|max:100',
            'last_name'=>'required|string|max:100',
            'phone'=>'nullable|string|max:30',
        ]);
        $user = User::create([
            'name'=>$data['first_name'].' '.$data['last_name'],
            'email'=>$data['email'],
            'phone'=>$data['phone'] ?? null,
            'password'=>$data['password'],
        ]);
        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->route('home')->with('success','Your account has been created.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    public function passwordReset(Request $request)
    {
        $request->validate(['email'=>'required|email']);
        $status = Password::sendResetLink($request->only('email'));
        return back()->with('status', __($status));
    }
}