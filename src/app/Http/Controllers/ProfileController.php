<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $profile = $user->profile;

        return view('mypage', compact('user', 'profile'));
    }
    
    public function create()
    {
        $user = auth()->user();
        $profile = Profile::firstOrNew(['user_id' => $user->id]);

        return view('profile', compact('user', 'profile'));
    }

    public function update(ProfileRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();

        if ($request->hasFile('profile_image')) {
            $data['profile_image_path'] = $request->file('profile_image')->store('profile', 'public');
        }
        unset($data['profile_image']);

        $data['user_id'] = $user->id;

        $isFirstTime = !$user->profile()->exists();

        Profile::updateOrCreate(
            ['user_id' => $user->id],
            $data
        );

        return $isFirstTime
        ? redirect()->route('home')
        : redirect()->route('mypage')->with('success', 'プロフィールを更新しました！');
    }
}
