<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * @param int $type
     * @param $message
     * @param bool $logMessage
     * @return RedirectResponse
     */
    private function handleErrorResponse(int $type, $message, bool $logMessage = false): RedirectResponse
    {
        if ($logMessage) {
            Log::error('An error occurred', [
                'path' => class_basename(self::class),
                'func' => 'register',
                'message' => $message,
            ]);
        }

        if ($type === 1) {
            return Redirect::route('register')->withErrors($message)->withInput();
        } else {
            return Redirect::route('register')->withErrors(['custom' => $message])->withInput();
        }
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view('register.form');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function register(Request $request): RedirectResponse
    {
        $validation = Validator::make($request->all(), [
            'user_name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string|max:255',
        ]);

        if ($validation->fails()) {
            return $this->handleErrorResponse(1, message: $validation, logMessage: true);
        } else if (!$user = User::create([
            'user_name' => $request->user_name,
            'password' => $request->password,
            'email' => $request->email,
            'name' => $request->name
        ])) {
            return $this->handleErrorResponse(2, '登録できませんでした。');
        } else if (!Auth::login($user)) {
            return $this->handleErrorResponse(2, 'ログインできませんでした。');
        }

        return Redirect::route('dashboard');
    }
}
