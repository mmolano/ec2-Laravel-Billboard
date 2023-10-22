<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use App\Jobs\SendEmail;


class PostController extends Controller
{
    /**
     * @param int $type
     * @param $message
     * @param bool $logMessage
     * @param string $id
     * @return RedirectResponse
     */
    private function handleErrorResponse(int $type, mixed $message, bool $logMessage = false, string $id): RedirectResponse
    {
        if ($logMessage) {
            Log::error('An error occurred', [
                'path' => class_basename(self::class),
                'func' => 'post',
                'message' => $message,
            ]);
        }

        $previousUrl = URL::previous();
        $previousRouteName = app('router')->getRoutes()->match(app('request')->create($previousUrl))->getName();

        if ($type === 1) {
            if ($previousRouteName === 'post.show') {
                return Redirect::route('post.show', ['id' => $id])->withErrors($message, 'validationFail');
            }

            return Redirect::route('dashboard')->withErrors($message)->withInput();
        } else {

            if ($previousRouteName === 'post.show') {
                return Redirect::route('post.show', ['id' => $id])->withErrors(['customUpdate' => $message])->withInput();
            }

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
            !$post = Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => $user->user_id
            ])
        ) {
            return $this->handleErrorResponse(2, message: '新しいメッセージを作成できませんでした。');
        }

        SendEmail::dispatch([
            'email' => $user->email,
            'url' => env('APP_URL') . '/dashboard',
            'nameOwner' => $user->name,
            'postUser' => $user->name,
            'postDate' => $post->created_at,
            'subject' => '新しいメッセージが作成されました。',
            'content' => $request->content
        ]);

        return Redirect::route('dashboard')->with('success', 'メッセージが作成されました！');
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Application|Factory|View
     */
    public function show(Request $request): RedirectResponse|Factory|View|Application
    {
        if (
            !$post = Post::with([
                'comments' => function ($query) {
                    $query->orderBy('created_at', 'desc');
                }
            ])->find($request->id)
        ) {
            return $this->handleErrorResponse(2, message: 'メッセージIDが見つかりませんでした。');
        }

        return view('post.show', compact('post'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Request $request): RedirectResponse
    {
        if (!$post = Post::where('post_id', $request->id)->first()) {
            return $this->handleErrorResponse(2, message: 'メッセージIDが見つかりませんでした。。');
        } elseif (Auth::check() && Auth::user()->user_id != $post->user_id) {
            return $this->handleErrorResponse(2, message: '削除できませんでした。');
        } elseif (Comment::where('post_id', $request->id)->first() && !Comment::where('post_id', $request->id)->delete()) {
            return $this->handleErrorResponse(2, message: 'メッセージのコメントを削除できませんでした。');
        } else if (!$post->delete()) {
            return $this->handleErrorResponse(2, message: '削除できませんでした。');
        }

        return Redirect::route('dashboard')->with('success', '削除できました！');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $validation = Validator::make($request->all(), [
            'title' => 'string|min:6',
            'content' => 'string|min:2',
        ]);

        if ($validation->fails()) {
            return $this->handleErrorResponse(1, message: $validation, logMessage: true, id: $request->id);
        } else if (!$post = Post::where('post_id', $request->id)->first()) {
            return $this->handleErrorResponse(2, message: 'メッセージIDが見つかりませんでした。', id: $request->id);
        } elseif (Auth::check() && Auth::user()->user_id != $post->user_id) {
            return $this->handleErrorResponse(2, message: '修正できませんでした。', id: $request->id);
        } else if (!$post->update($request->only('title', 'content'))) {
            return $this->handleErrorResponse(2, message: '修正できませんでした。', id: $request->id);
        }

        $previousUrl = URL::previous();
        $previousRouteName = app('router')->getRoutes()->match(app('request')->create($previousUrl))->getName();

        if ($previousRouteName === 'post.show') {
            return Redirect::route('post.show', ['id' => $request->id])->with('update', '修正できました！');
        }

        return Redirect::route('dashboard')->with('success', '修正できました！');
    }
}