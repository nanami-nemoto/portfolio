@extends('layouts.default')
 
@section('header')
<header>
  <div class="flex">
    <div>
      <a href="{{ route('posts.index') }}"><img class="header_logo" src="{{ asset('images/header_logo.png') }}"></a>
    </div>
    <div class="header_right">
      <ul class="flex header_list header_right">
        <li>
          <a href="{{ route('users.show', Auth::id()) }}">ユーザープロフィール</a>
        </li>
        <li>
          <a class="btn btn-info" href="{{ route('posts.create') }}" role="button">
            新規投稿
          </a>
        </li>
        <li>
          <form action="{{ route('logout') }}" method="post">
            @csrf
            <input class="btn btn-secondary" type="submit" value="ログアウト">
          </form>
        </li>
      </ul>
    </div>
  </div>
</header>
@endsection