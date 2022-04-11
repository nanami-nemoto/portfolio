@extends('layouts.default')
 
@section('header')
<header>
    <ul class="flex header_list">
        <li>
          <a href="{{ route('register') }}">
            ユーザー登録
          </a>
        </li>
        <li>
          <a href="{{ route('login') }}">
            ログイン
          </a>
        </li>
    </ul>
</header>
@endsection