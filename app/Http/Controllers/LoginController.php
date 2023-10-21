<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {
        return view('login.form');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        $validation = Validator::make($request->all(), [
            'password' => 'required|string|min:6',
            'user_name' => 'required|string',
        ]);

        if ($validation->fails()) {
            return Redirect::route('login')->withErrors($validation);
        }

        if (!Auth::attempt($request->only('user_name', 'password'))) {
            return Redirect::route('login')->withErrors(['login' => 'ログイン情報が間違っています。']);
        }
        
        return Redirect::route('dashboard');
    }
}
