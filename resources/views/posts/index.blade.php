@extends('layouts.logged_in')

@section('title', '投稿一覧')

@section('content')
    <div class="main_contents">
      <h1>投稿一覧</h1>
      
      <ul class="comment_list">
          @forelse($posts as $post)
            <li>
                投稿者: {{ $post->user->name }} ( {{ $post->created_at }} )<br>
                {!! nl2br(e($post->comment)) !!}<br>
                @if($post->image !== "")
                    <img class="comment_image" src="{{ asset('storage/' . $post->image) }}">
                @endif
                
                <div>
                  <a href="{{ route('posts.edit', $post) }}">[ コメントを編集 ]</a>
                  <a href="{{ route('posts.edit_image', $post) }}">[ 画像を編集 ]</a>
                </div>
                
                <form method="post" action="{{ route('posts.destroy', $post) }}" onsubmit="return window.confirm('本当に削除しますか？')">
                  @csrf
                  @method('delete')
                    <input class="btn btn-secondary" type="submit" value="削除">
                </form>
            </li>
          @empty
            <li>投稿がありません。</li>
        　@endforelse
      </ul>
    </div>
    
@endsection