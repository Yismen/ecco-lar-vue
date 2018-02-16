<?php

namespace App\Http\Controllers\User;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserSetting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $settings = [
            'data' => json_encode($request->only('route', 'layout', 'skin', 'sidebar_collapse', 'sidebar_mini'))
        ];

        if (!$user->settings) {
            $user->settings()->create($settings);
        } else {
            $user->settings()->update($settings);
        }
        
        return back();
    }
}
