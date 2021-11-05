<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return View('Admin\Auth\login');
    }

    public function SubmitLogin(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|max:191',
            'password' => 'required|max:191',
        ]);
        if (! auth()->guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return back();
        }
        return redirect(route('admin.homepage'));
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect(route('admin.login'));
    }
}
