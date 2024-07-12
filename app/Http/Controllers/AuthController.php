<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function loginView()
    {
        return view('login');
    }

    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $user = Admin::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect()->route('index')->with('success', 'Login berhasil');
            } else {
                return redirect()->back()->withErrors(['password' => 'Password mismatch'])->withInput();
            }
        } else {
            return redirect()->back()->withErrors(['email' => 'User does not exist'])->withInput();
        }
    }

    // public function login(Request $request)
    // {

    //     $validator = Validator::make($request->all(), [
    //         'email' => ['required', 'email', 'exists:admins'],
    //         'password' => ['required'],
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     $validated = $validator->validated();

    //     if (Auth::attempt(array('email' => $validated['email'], 'password' => $validated['password']))) {
    //         return redirect()->route('index');
    //     } else {
    //         $validator->errors()->add(
    //             'password', 'The password does not match with username'
    //         );
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
    // }

    public function registerView(){
        return view('register');
    }

    public function register(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'email','unique:users'],
            'password' => ['required',"confirmed", Password::min(7)],
        ]);

        $validated = $validator->validated();

        $user = User::create([
            'name' => $validated["name"],
            "email" => $validated["email"],
            "password" => Hash::make($validated["password"])
        ]);

        auth()->login($user);

        return redirect()->route('index');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
