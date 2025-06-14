<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class ProfileController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware(['auth', 'auth.banned']), 
        ];
    }

    public function show($id)
    {
        $user = User::find($id);
        if(!$user) {
            return redirect()->route('profile.show', ['id' => Auth::id()])->with('error', 'User not found');
        }
        return view('profile.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);

        if(!$user) {
            return redirect()->route('profile.show', ['id' => Auth::id()])->with('error', 'User not found');
        }

        if(Auth::user()->is_admin || Auth::user()->is_moderator) {
            return view('profile.edit', compact('user'));
        }

        if(Auth::id() !== $user->id) {
            return redirect()->route('profile.show', ['id' => Auth::id()])->with('error', 'Permission denied');
        }

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if(!$user) {
            return redirect()->route('profile.show', ['id' => Auth::id()])->with('error', 'User not found');
        }

        if(Auth::id() !== $user->id && !Auth::user()->is_admin && !Auth::user()->is_moderator) {
            return redirect()->route('profile.show', ['id' => Auth::id()])->with('error', 'Permission denied');
        }

        $request->validate([
            'name' => 'required|string|min:1|max:255|unique:users,name,' . $user->id,
            'email' => 'required|string|min:1|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'role' => 'nullable|in:administrator,moderator,user',
            'status' => 'nullable'
        ]);

        if($request->name !== $user->name) {
            $user->name = $request->name;
        }

        if($request->email !== $user->email) {
            $user->email = $request->email;
            $user->email_verified_at = NULL;
        }

        if($request->image && $request->image !== $user->image) {
            if($user->image) {
                Storage::delete($user->image);
            }
            $user->image = $request->file('image')->store('profile_images', 'public');
        }

        if($request->role && Auth::user()->is_admin) {
            if($request->role == 'administrator' && $user->is_admin == false) {
                if($user->is_moderator == true) {
                    $user->is_admin = true;
                    $user->is_moderator = false;
                } else {
                    $user->is_admin = true;
                }
            }
            
            if($request->role == 'moderator' && $user->is_moderator == false) {
                if($user->is_admin == true) {
                    $user->is_moderator = true;
                    $user->is_admin = false;
                } else {
                    $user->is_moderator = true;
                }
            }

            if($request->role == 'user') {
                if($user->is_admin == true) {
                    $user->is_admin = false;
                }

                if($user->is_moderator == true) {
                    $user->is_moderator = false;
                }
            }
        }

        if($request->status && Auth::user()->is_admin) {
            if($user->isNotBanned()) {
                $user->ban();
            }
        }

        if($request->status === NULL && Auth::user()->is_admin) {
            if($user->isBanned()) {
                $user->unban();
            }
        }

        $user->save();
        return redirect()->route('profile.show', ['id' => $user->id])->with('success', 'Profile updated successfully');
    }
}
