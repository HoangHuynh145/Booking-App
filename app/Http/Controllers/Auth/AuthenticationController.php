<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticationController extends Controller
{

    public function create(): View 
    {
        return view('auth.login');
    }

    public function store(Request $request): RedirectResponse 
    {
        $data = $request->all();
        $input = $data['username'];
        $password = $data['password'];
        $user = null;
        if(str_contains($input, '@')) {
            $user = Users::where([['deleteFlag', 0], ['email', $input]])->first();
        } else {
            $user = Users::where([['deleteFlag', 0], ['fullName', $input]])->first();
        }

        if($user) {
            $token = auth()->attempt(['email' => $user->email, 'password' => $password]);
            if(!$token) {
                return redirect()->route('login')->with('error', 'Lỗi. Vui lòng kiểm tra lại thông tin đăng nhập.');
            } else {
                $request->session()->invalidate();
                $request->session()->put('user', $user);
                Auth::login($user);
                return redirect()->intended('/');
            }
        } else {
            return redirect()->route('login')->with('error', 'Lỗi. Vui lòng kiểm tra lại thông tin đăng nhập.');
        }
        
        return redirect('/dashboard');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
