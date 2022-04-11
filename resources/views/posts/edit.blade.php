@extends('layouts.logged_in')

@section('title', 'コメント編集')

@section('content')
    <div class="main_contents">
        <h1>コメント編集</h1>
        
        <form method="post" action = "{{ route('posts.update', $post) }}">
            @csrf
            @method('patch')
            <div>
                <label>
                    コメント:<br>
                    <textarea name="comment" rows="5" cols="50">{{ $post->comment }}</textarea>
                </label>
            </div>
            <input class="btn btn-primary" type="submit" value="更新">
        </form>
    </div>
@endsection