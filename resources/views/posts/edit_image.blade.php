@extends('layouts.logged_in')

@section('title', '画像編集')

@section('content')
    <div class="main_contents">
        <h1>画像編集</h1>
        <h2>現在の画像</h2>
            @if($post->image !== '')
                <img class="comment_image" src="{{ asset('storage/' . $post->image) }}">
            @else
                <p>画像はありません。</p>
            @endif
        
        <form method="post" action = "{{ route('posts.update_image', $post) }}" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div>
                <label>
                    画像を選択:<br>
                    <input type="file" name="image">
                </label>
            </div>
            <input class="btn btn-primary" type="submit" value="更新">
        </form>
    </div>
@endsection