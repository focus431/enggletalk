<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * 儲存一個新的評論。
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @method bool isMentee()
     */
    public function store(Request $request)
    {
        
    // 獲取當前用戶
    $user = auth()->user();

    // 確保用戶已經登錄且角色為 Mentee
    if (!$user || !$user->isMentee()) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

        // 特別檢查和記錄 blog_id
        if ($request->has('blog_id')) {
            logger()->info('Received blog_id', ['blog_id' => $request->input('blog_id')]);
        } else {
            logger()->warning('blog_id is missing in the request');
        }

        // 驗證輸入數據
        $validatedData = $request->validate([
            'content' => 'required',
            'blog_id' => 'required|integer',
            'email' =>  'required',
            'name' =>  'required'
        ]);

        // 獲取當前用戶
        $user = auth()->user();

        // 確保用戶已經登錄
        if (!$user) {
            return response()->json(['message' => 'User not authenticated'], 401);
        }
        // 拼接 first_name 和 last_name

        // 創建新的評論
        $comment = new Comment();
        $comment->blog_id = $validatedData['blog_id'];
        $comment->content = $validatedData['content'];
        $comment->user_id = $user->id;
        $comment->name = $validatedData['name'];
        $comment->email = $validatedData['email'];
        
        $comment->avatar_path = $user->avatar_path;
        $comment->save();

        // 可以返回一個響應，例如創建成功的訊息或重定向
        return response()->json(['message' => 'Comment successfully created', 'comment' => $comment], 201);
    }





    public function getCommentsByBlog($blogId)
    {
        // 從資料庫中檢索與 blog_id 匹配的評論
        $comments = Comment::where('blog_id', $blogId)->get();

        // 返回評論數據
        return response()->json($comments);
    }
}
