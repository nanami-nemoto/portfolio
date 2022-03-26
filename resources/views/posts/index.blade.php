@extends('layouts.logged_in')

@section('title', '投稿一覧')

@section('content')
    <div class="main_contents">
      <div class="recommended_users">
        あなたにおすすめのユーザー
        <ul class="recommended_list">
          @forelse($recommended_users as $recommended_user)
            <li><a href="{{ route('users.show', $recommended_user->id) }}">{{ $recommended_user->name }}</a></li>
          @empty
            <li>他のユーザーが存在しません</li>
          @endforelse
        </ul>
      </div>
      
      <h1>投稿一覧</h1>
      <ul class="comment_list">
          @forelse($posts as $post)
            <li>
                投稿者: <a href="{{ route('users.show', $post->user_id) }}">{{ $post->user->name }}</a> ( {{ $post->created_at }} )<br>
                {!! nl2br(e($post->comment)) !!}<br>
                @if($post->image !== "")
                    <img class="comment_image" src="{{ asset('storage/' . $post->image) }}">
                @endif
                
                @if($post->user_id === Auth::id())
                  <div>
                    <a href="{{ route('posts.edit', $post) }}">[ コメントを編集 ]</a>
                    <a href="{{ route('posts.edit_image', $post) }}">[ 画像を編集 ]</a>
                  </div>
                  
                  <form method="post" action="{{ route('posts.destroy', $post) }}" onsubmit="return window.confirm('本当に削除しますか？')">
                    @csrf
                    @method('delete')
                      <input class="btn btn-secondary" type="submit" value="削除">
                  </form>
                @endif
            </li>
          @empty
            <li>投稿がありません。</li>
        　@endforelse
      </ul>
    </div>
    
@endsection