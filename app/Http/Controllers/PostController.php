<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostImageRequest;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $posts = \Auth::user()->posts()->latest()->get();
        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequest $request)
    {
        $path = "";
        $image = $request->file('image');
        
        if(isset($image)===true) {
            $path = $image->store('posts','public');
        }
        
        Post::create([
            'user_id' => \Auth::user()->id,
            'comment' => $request->comment,
            'image' => $path,
        ]);
        
        session()->flash('success', '投稿を追加しました。');
        return redirect()->route('posts.index');
    }

    public function edit(Post $post)
    {
        if($post->user_id !== \Auth::user()->id) {
            abort(403);
        }
        
        return view('posts.edit', [
            'post' => $post,
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->only(['comment']));
        session()->flash('success', 'コメントを編集しました。');
        return redirect()->route('posts.index');
    }
    
    public function editImage(Post $post) {
        if($post->user_id !== \Auth::user()->id) {
            abort(403);
        }
        
        return view('posts.edit_image', [
            'post' => $post,
        ]);
    }
    
    public function updateImage(PostImageRequest $request, Post $post) {
        $path = '';
        $image = $request->file('image');
        
        if(isset($image) === true) {
            $path = $image->store('posts', 'public');
        }
        
        if($post->image !== '') {
            \Storage::disk('local')->delete('public/' . $post->image);
        }
        
        $post->update([
            'image' => $path
        ]);
        
        session()->flash('success', '画像を変更しました。');
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        if($post->image !== "") {
            \Storage::disk('local')->delete('public/' . $post->image);
        }
        $post->delete();
        session()->flash('success', '投稿を削除しました。');
        return redirect()->route('posts.index');
    }
}
