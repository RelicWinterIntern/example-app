<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\Like;

class LikeController extends Controller
{
    // ポストIDに紐づくポストにいいねする
    public function like($post_id)
    {
        // Likeモデルの新しいインスタンスを作成
        $like = new Like;
        // ユーザIDとポストIDを設定して保存
        $like->user_id = Auth::user()->id;
        $like->post_id = $post_id;
        $like->save();
        // 呼び出し元ページにリダイレクト
        return redirect()->back();
    }

    // ポストIDに紐づくポストのいいねを外す
    public function unlike($post_id)
    {
        // 現在のユーザIDを取得
        $user_id = Auth::user()->id;

        // 特定の投稿とユーザーに関連するLikeモデルを検索
        $like = Like::where('post_id', $post_id)->where('user_id', $user_id)->first();
        // Likeモデルが見つかった場合、削除
        if ($like) {
            $like->delete();
        }
        // 呼び出し元ページにリダイレクト
        return redirect()->back();
    }
}
