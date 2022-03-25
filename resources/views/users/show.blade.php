@extends('layouts.logged_in')

@section('title', 'プロフィール')

@section('content')
    <div class="main_contents">
        <h1>プロフィール</h1>
        <p>{{ $user->name }}</p>
        @if($user->image === '')
            <img class="user_image" src="{{ asset('images/no_image.png') }}">
        @else
            <img class="user_image" src="{{ asset('storage/' . $user->image) }}">
        @endif
        <p>{!! nl2br(e($user->profile)) !!}</p>
        
        @if($user->id === Auth::id())
            <a href="{{ route('users.edit') }}">[ プロフィールを編集 ]</a>
            <a href="{{ route('users.edit_image') }}">[ 画像を編集 ]</a>
            
        @else
            @if(Auth::user()->isFollowing($user))
                <form method="post" action="{{ route('follows.destroy', $user) }}" class="follow">
                    @csrf
                    @method('delete')
                    <input type="submit" value="フォロー解除" class="btn btn-secondary">
                </form>
            @else
                <form method="post" action="{{route('follows.store')}}" class="follow">
                    @csrf
                    <input type="hidden" name="follow_id" value="{{ $user->id }}">
                    <input type="submit" value="フォローする" class="btn btn-primary">
                </form>
            @endif
        @endif
        
        <div class="comment_index">
            <h2>投稿一覧</h2>
            <ul class="comment_list">
                @forelse($posts as $post)
                    <li>
                        {!! nl2br(e($post->comment)) !!}<br>
                        @if($post->image !== "")
                            <img class="comment_image" src="{{ asset('storage/' . $post->image) }}"><br>
                        @endif
                        ( {{ $post->created_at }} )<br>
                    </li>
                @empty
                    <li>投稿はありません。</li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection