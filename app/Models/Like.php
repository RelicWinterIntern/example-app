<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'post_id'];

    // Likeモデルは１つのUserモデルに属する関係を定義する
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Likeモデルは１つのPostモデルに属する関係を定義する
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
