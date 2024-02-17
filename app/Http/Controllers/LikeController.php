<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use App\Models\Like;

class LikeController extends Controller
{
    public function like($postId)
    {
        $userId = Auth::user()->id;
        
        $like = new Like;
        $like->user_id = $userId;
        $like->post_id = $postId;
        $like->save();

        return redirect()->back();
    }

    public function unlike($postId)
    {
        $userId = Auth::user()->id;

        $like = Like::where('post_id', $postId)->where('user_id', $userId)->first();
        $like->delete();

        return redirect()->back();
    }
}
