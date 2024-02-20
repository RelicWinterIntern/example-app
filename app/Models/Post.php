<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'author_name'];

    // Postモデルは１つのUserモデルに属する関係を定義
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Postモデルは複数のLikeモデルを持つ関係を定義
    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id');
    }

    // ポストにいいねがされているかを判定するメソッド
    public function is_liked()
    {
        // 現在のユーザのIDを取得
        $id = Auth::id();
        // いいねをしたユーザのIDを格納するための配列を初期化
        $likers = array();
        // ポストに対するいいねを取得し、ユーザIDを配列に追加
        foreach($this->likes as $like) {
            array_push($likers, $like->user_id);
        }
        // 現在のユーザのIDがいいねをしたユーザーの配列に含まれているかを判定
        if (in_array($id, $likers)) {  // いいねがされている場合はtrueを返す
            return true;
        } else {  // いいねがされていない場合はfalseを返す
            return false;
        }
    }
}
