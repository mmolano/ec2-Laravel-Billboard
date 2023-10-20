<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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
        } else if (!$post = Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => $user->user_id
        ])) {
            return $this->handleErrorResponse(2, message: '新しいポストを作成できませんでした。');
        }

        if(!SendEmail::dispatch([
            'email' => $user->email, 
            'url' => env('APP_URL').'/dashboard',
            'name' => $user->name, 
            'subject' => '新しいメッセージが作成されました。', 
            'content' => $request->content
        ])) {
            return $this->handleErrorResponse(2, message: 'Error: メールを送信できませんでした。');
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

        return view('post.show', compact('post'));
    }

     /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Request $request): RedirectResponse
    {
        if (!$post = Post::where('post_id', $request->id)->first()) {
            return $this->handleErrorResponse(2, message: 'ポストIDが見つかりませんでした。。', id: $request->post_id);
        } elseif(Auth::check() && Auth::user()->user_id !== $post->user_id){
            return $this->handleErrorResponse(2, message: '削除できませんでした。', id: $request->post_id);
        } elseif (!Comment::where('post_id', $request->id)->delete()) {
            return $this->handleErrorResponse(2, message: 'ポストのコメントを削除できませんでした。', id: $request->post_id);
        } else if (!$post->delete()) {
            return $this->handleErrorResponse(2, message: '削除できませんでした。', id: $request->post_id);
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
            return $this->handleErrorResponse(1, message: $validation, logMessage: true, id: $request->post_id);
        } else if (!$post = Post::where('post_id', $request->id)->first()) {
            return $this->handleErrorResponse(2, message: 'ポストIDが見つかりませんでした。', id: $request->post_id);
        } elseif(Auth::check() && Auth::user()->user_id !== $post->user_id){
            return $this->handleErrorResponse(2, message: '編集できませんでした。', id: $request->post_id);
        } else if (!$post->update($request->only('title', 'content'))) {
            return $this->handleErrorResponse(2, message: '編集できませんでした。', id: $request->post_id);
        }

        return Redirect::route('dashboard')->with('success', '編集できました！');
    }
}