@extends('layouts.not_logged_in')

@section('title', 'ログイン')

@section('content')
    <div class="main_contents">
        <h1>ログイン</h1>

        <form method="post" action="{{ route('login') }}" class="main_content_form">
            @csrf
            <div>
                <label>
                    <p>メールアドレス:</p>
                    <input type="email" name="email">
                </label>
            </div>
            
            <div>
                <label>
                    <p>パスワード:</p>
                    <input type="password" name="password">
                </label>
            </div>
            
            <div>
                <input class="btn btn-primary" type="submit" value="ログイン">
            </div>
        </form>
    </div>
@endsection