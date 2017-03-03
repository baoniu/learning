<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostsController extends Controller
{
    public function show($id)
    {
        $post = Post::findOrFail($id);
        \Auth::loginUsingId(31);

//        if(Gate::denies('show-post', $post)) {
//            abort(403, 'Sorry');
//        }
//        $this->authorize('show-post', $post);
//        return $post->title;

        return view('posts.show', compact('post'));
    }
}
