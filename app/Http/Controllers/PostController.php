<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
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
                'func' => 'post',
                'message' => $message,
            ]);
        }

        if ($type === 1) {
            return Redirect::route('dashboard')->withErrors($message)->withInput();
        } else {
            return Redirect::route('dashboard')->withErrors(['custom' => $message])->withInput();
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required|string|min:6',
            'content' => 'required|string|min:2',
        ]);

        if (!$user = Auth::user()) {
            return $this->handleErrorResponse(2, message: 'Error: 管理者に連絡してください。');
        } else if ($validation->fails()) {
            return $this->handleErrorResponse(1, message: $validation, logMessage: true);
        } else if (
            !Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => $user->user_id
            ])
        ) {
            return $this->handleErrorResponse(2, message: '新しいポストを作成できませんでした。');
        }

        return Redirect::route('dashboard')->with('success', 'ポストが作成されました！');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Application|Factory|View
     */
    public function show(Request $request): RedirectResponse|Factory|View|Application
    {
        if (!$post = Post::with(['comments' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->find($request->id)) {
            return $this->handleErrorResponse(2, message: 'ポストIDが見つかりませんでした。');
        }

        return view('posts.show', compact('post'));
    }
}