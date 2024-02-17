<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\Like;

class LikeController extends Controller
{
    public function like(Post $post)
    {
        $userId = Auth::user()->id;
        $postId = $post->id;
        
        $like = new Like;
        $like->user_id = $userId;
        $like->post_id = $postId;
        $like->save();

        return redirect()->back();
    }

    public function unlike(Post $post)
    {
        $userId = Auth::user()->id;
        $postId = $post->id;

        $like = Like::where('post_id', $postId)->where('user_id', $userId)->first();
        if ($like) {
            $like->delete();
        }
        return redirect()->back();
    }
}
