<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //$posts = Post::where('user_id', Auth::user()->id)->get();
        $posts = Post::all();
        return view('post.index')->with(compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->content = $request->input('content');
        $post->save();

        return back();
    }

    public function edit($id)
    {
        //dd($id);
        $post = Post::find($id);

        return view('post.edit')->with(compact('post'));
    }

    public function update(Request $request)
    {

        $post = Post::find($request->input('id'));
        if($post->user_id == Auth::user()->id){
            $post->content = $request->input('content');
            $post->save();
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
