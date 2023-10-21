<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Jobs\SendEmail;

class CommentController extends Controller
{
    /**
     * @param int $type
     * @param $message
     * @param bool $logMessage
     * @return RedirectResponse
     */
    private function handleErrorResponse(int $type, $message, bool $logMessage = false, string $id): RedirectResponse
    {
        if ($logMessage) {
            Log::error('An error occurred', [
                'path' => class_basename(self::class),
                'func' => 'comment',
                'message' => $message,
            ]);
        }

        if ($type === 1) {
            return Redirect::route('post.show', ['id' => $id])->withErrors($message)->withInput();
        } else {
            return Redirect::route('post.show', ['id' => $id])->withErrors(['custom' => $message])->withInput();
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validation = Validator::make($request->all(), [
            'comment_content' => 'required|string',
            'post_id' => 'required|string'
        ]);

        if (!$user = Auth::user()) {
            return $this->handleErrorResponse(2, message: 'Error: 管理者に連絡してください。', id: $request->post_id);
        } else if ($validation->fails()) {
            return $this->handleErrorResponse(1, message: $validation, logMessage: true, id: $request->post_id);
        } else if (
            !$comment = Comment::create([
                'comment_content' => $request->comment_content,
                'post_id' => $request->post_id,
                'user_id' => $user->user_id
            ])
        ) {
            return $this->handleErrorResponse(2, message: '作成できませんでした。', id: $request->post_id);
        }

        if (!$post = Post::where('post_id', $request->post_id)->first()) {
            return $this->handleErrorResponse(2, message: 'コメントが作成されましたが、エラーが発生いたしました。', id: $request->post_id);
        }

        if($user->user_id != $post->user_id) {
            if (!$userOwner = User::where(['user_id' => $post->user_id])->first()) {
            return $this->handleErrorResponse(2, message: 'コメントが作成されましたが、エラーが発生いたしました。', id: $request->post_id);
            } 
            
            SendEmail::dispatch([
                'email' => $userOwner->email, 
                'url' => env('APP_URL').'/post/'.$request->post_id,
                'nameOwner' => $userOwner->name, 
                'postUser' => $user->name,
                'postDate' => $comment->created_at,
                'subject' => '新しいコメントが届けました', 
                'content' => $request->comment_content
            ]);
        }

        return Redirect::route('post.show', ['id' => $request->post_id])->with('success', 'コメントが作成されました！');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Request $request): RedirectResponse
    {
        if (!$comment = Comment::where('comment_id', $request->id)->first()) {
            return $this->handleErrorResponse(2, message: 'コメントIDが見つかりませんでした。', id: $request->post_id);
        } elseif(Auth::check() && Auth::user()->user_id != $comment->user_id){
            return $this->handleErrorResponse(2, message: '削除できませんでした。', id: $request->post_id);
        } else if (!$comment->delete()) {
            return $this->handleErrorResponse(2, message: '削除できませんでした。', id: $request->post_id);
        }

        return Redirect::route('post.show', ['id' => $request->post_id])->with('success', '削除できました！');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $validation = Validator::make($request->all(), [
            'comment_content' => 'required|string',
        ]);

        if ($validation->fails()) {
            return $this->handleErrorResponse(1, message: $validation, logMessage: true, id: $request->post_id);
        } else if (!$comment = Comment::where('comment_id', $request->id)->first()) {
            return $this->handleErrorResponse(2, message: 'コメントIDが見つかりませんでした。。', id: $request->post_id);
        } elseif(Auth::check() && Auth::user()->user_id != $comment->user_id){
            return $this->handleErrorResponse(2, message: '修正できませんでした。', id: $request->post_id);
        } else if (!$comment->update($request->only('comment_content'))) {
            return $this->handleErrorResponse(2, message: '修正できませんでした。', id: $request->post_id);
        }

        return Redirect::route('post.show', ['id' => $request->post_id])->with('success', '修正できました！');
    }
}
