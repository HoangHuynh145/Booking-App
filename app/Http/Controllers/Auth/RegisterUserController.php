<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisterUserController extends Controller
{
    //
    public function create(): View 
    {
        return view('auth/register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullName' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'min:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Users::class],
            'password' => ['required', 'confirmed']
        ]);

        $user = Users::create([
            'fullName' => $request->fullName,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        $request->session()->put('user', $user);
        Auth::login($user);
        return redirect()->intended('/');
    }
}
