<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class AuthController extends Controller
{
    function Login()
    {
        return view('auth.login');
    }

    function Authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            //add redirect for admin and users || condition

            if (Auth::user()->role === "Proctor") {
                return redirect()->route('admin.dashboard.overview.proctor');
            } else if (Auth::user()->role === "Student") {
                return redirect()->route('home');
            }
            else if(Auth::user()->role === "Dean" ){
                return redirect()->route('admin.overview.dean');
            }
            else if(Auth::user()->role === "ProgramHead"){
                return redirect()->route('admin.dashboard.admission');
            }
            return redirect()->intended('/')->with('status', 'Login Successfull');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email')->withInput();
    }

    public function CreateAccountUser(Request $request)
    {
        $validatedData = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = new User();
        $user->first_name = $validatedData['firstName'];
        $user->last_name = $validatedData['lastName'];
        $user->username = substr($validatedData['firstName'], 0, 1) . $validatedData['lastName'];;
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->role = 'User';        
        $user->save();

        return redirect()->route('home')->with('status', 'Registration Successfull');
    }

    public function ShowAdminRegistration()
    {
        return view('auth/register');
    }
    public function CreateAccountAdmin(Request $request)
    {
           
        $validatedData = $request->validate([

            'role' => 'required|in:ProgramHead,Proctor,Dean',
            'email' => 'required|email:rfc,dns,unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = new User();
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->role = $validatedData['role'];
        $user->status = "Active";
        $user->save();

        return redirect()->route('auth.login')->with('success', 'Registration Successfull');
    }

    public function Logout(Request $request)
    {
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('status', 'Logout Successfully');
    }

    public function ShowForgotPassword(){
        return view('auth.forgot-password');

    }
}
