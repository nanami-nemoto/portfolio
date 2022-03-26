@extends('layouts.logged_in')

@section('title', 'プロフィール画像編集')

@section('content')
    <div class="main_contents">
        <h1>プロフィール画像編集</h1>
        <h2>現在の画像</h2>
            @if($user->image === '')
                <img class="user_image" src="{{ asset('images/no_image.png') }}">
            @else
                <img class="user_image" src="{{ asset('storage/' . $user->image) }}">
            @endif
        
        <form method="post" action = "{{ route('users.update_image') }}" enctype="multipart/form-data">
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