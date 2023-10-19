<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

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
            return Redirect::route('posts.show', ['id' => $id])->withErrors($message)->withInput();
        } else {
            return Redirect::route('posts.show', ['id' => $id])->withErrors(['custom' => $message])->withInput();
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
            !Comment::create([
                'comment_content' => $request->comment_content,
                'post_id' => $request->post_id,
                'user_id' => $user->user_id
            ])
        ) {
            return $this->handleErrorResponse(2, message: '作成できませんでした。', id: $request->post_id);
        }

        return Redirect::route('posts.show', ['id' => $request->post_id])->with('success', 'コメントが作成されました！');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Request $request): RedirectResponse
    {
        if (!$comment = Comment::where('comment_id', $request->id)->first()) {
            return $this->handleErrorResponse(2, message: 'コメントIDが見つかりませんでした。。', id: $request->post_id);
        } else if (!$comment->delete()) {
            return $this->handleErrorResponse(2, message: '削除できませんでした。', id: $request->post_id);
        }

        return Redirect::route('posts.show', ['id' => $request->post_id])->with('success', '削除できました！');
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
        } else if (!$comment->update($request->only('comment_content'))) {
            return $this->handleErrorResponse(2, message: '編集できませんでした。', id: $request->post_id);
        }

        return Redirect::route('posts.show', ['id' => $request->post_id])->with('success', '編集できました！');
    }
}
