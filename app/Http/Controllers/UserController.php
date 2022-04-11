<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserImageRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show(User $user)
    {
        $posts = $user->posts()->latest()->get();
        
        return view('users.show', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
    
    public function edit()
    {
        return view('users.edit',[
            'user' => \Auth::user(),
        ]);
    }
    
    public function update(UserRequest $request)
    {
        $user = \Auth::user();
        $profile = '';
        if ($request->filled('profile')) {
            $profile = $request->profile;
        }
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'profile' => $profile
        ]);
        session()->flash('success', 'プロフィールを更新しました。');
        return redirect()->route('users.show', $user);
    }
    
    public function editImage()
    {
        return view('users.edit_image', [
            'user' => \Auth::user(),
        ]);
    }
    
    public function updateImage(UserImageRequest $request)
    {
        $user = \Auth::user();
        $path = '';
        $image = $request->file('image');
        if(isset($image) === true) {
            $path = $image->store('users', 'public');
        }
        
        if($user->image !== '') {
            \Storage::disk('local')->delete('public/' . $user->image);
        }
        $user->update([
            'image' => $path
        ]);
        
        session()->flash('success', 'プロフィール画像を編集しました。');
        return redirect()->route('users.show', $user);
    }
}
