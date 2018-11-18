<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function reset()
    {
        return view('users.reset');
    }

    public function change(User $user, Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
            'new_password_confirmation' => 'same:new_password',
        ]);

        $user = User::whereEmail(
            auth()->user()->email
            )
            ->first();

        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect('admin')
                ->withSuccess('Your password has been changed');
        }

        return redirect('/admin/users/reset')->withErrors(['old_password' => 'Wrong old password.']);
    }

    public function force_reset(User $user)
    {
        return view('users.force_reset', compact('user'));
    }

    public function force_change(User $user, Request $request)
    {
        if ($user->id === auth()->user()->id) {
            return redirect()->back()->withErrors(['error' => 'You are not allowed to change your own password here!']);
        }

        $new_password = $user->forceChangePassword($request);

        return redirect("/admin/users/force_reset/{$user->id}")
            ->with('important')
            ->withNewPassword($new_password)
            ->withWarning("Password {$new_password} is the new password for this user. Please advise to update inmediately!");
    }
}
