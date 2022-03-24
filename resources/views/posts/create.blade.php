@extends('layouts.logged_in')

@section('title', '新規投稿')

@section('content')
    <div class="main_contents">
        <h1>新規投稿</h1>
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" >
            @csrf
            <div>
                <label>
                    コメント:<br>
                    <textarea name="comment" rows="5" cols="50"></textarea>
                </label>
            </div>
            <div>
                <label>
                    画像: 
                    <input type="file" name="image">
                </label>
            </div>
            <input class="btn btn-primary" type="submit" value="投稿">
        </form>
    </div>
@endsection