<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'desc')->get();
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'topic_tag' => 'required|string',
            'image' => 'file|image',
        ]);

        // フォームでリクエストされた画像を取得
        $img = $request->file('image');

        $post = new Post();
        $post->title = $validatedData['title'];
        $post->body = $validatedData['body'];
        $post->topic_tag = $validatedData['topic_tag'];

        // 画像情報がセットされていれば、保存処理を実行
        if (isset($img)) {
            // アップロードされたファイル名を取得
            $file_name = $request->file('image')->getClientOriginalName();
            // storage > public > img 配下に画像が一時的に保存される
            $dir = 'img';
            $img->storeAs('public/' . $dir, $file_name);
            $imgPath = 'storage/' . $dir . '/' . $file_name;
            // store処理が実行できたらDBに保存処理を実行
            if ($imgPath) {
                // DBにPathを登録する処理
                $post->img_path = $imgPath;
            }
        }

        $post->user_id = Auth::id();
        $post->save();

        return redirect()->route('post.index')->with('success', '投稿が作成されました');
    }

    public function myPosts()
    {
        $posts = Post::where('user_id', Auth::id())->orderBy('updated_at', 'desc')->get();
        return view('my-posts', compact('posts'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'topic_tag' => 'required|string',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $validatedData['title'];
        $post->body = $validatedData['body'];
        $post->topic_tag = $validatedData['topic_tag'];
        $post->save();

        return redirect()->route('myposts')->with('success', '投稿が更新されました');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('myposts')->with('success', '投稿が削除されました');
    }
}

