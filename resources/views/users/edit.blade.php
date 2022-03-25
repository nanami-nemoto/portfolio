@extends('layouts.logged_in')

@section('title', 'プロフィール編集')

@section('content')
    <div class="main_contents">
        <h1>プロフィール編集</h1>
        <form method="post" action="{{ route('users.update') }}" class="main_content_form">
            @csrf
            @method('patch')
            <div>
                <label>
                    <p>
                        ユーザー名:<br>
                        <input type="text" name="name" value="{{ $user->name }}">
                    </p>
                </label>
            </div>
            <div>
                <label>
                    <p>
                        メールアドレス:<br>
                        <input type="email" name="email" value="{{ $user->email }}">
                    </p>
                </label>
            </div>
            <div>
                <label>
                    <p>
                        自己紹介:<br>
                        <textarea name="profile" rows="10" cols="50">{{ $user->profile }}</textarea>
                    </p>
                </label>
            </div>
            <input class="btn btn-primary" type="submit" value="更新">
        </form>
    </div>
@endsection