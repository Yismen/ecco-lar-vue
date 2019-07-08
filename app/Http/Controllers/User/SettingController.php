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
     * @param \Illuminate\Http\Request $request
     * @param \App\UserSetting         $setting
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $settings = [
            'data' => json_encode($request->only('layout', 'skin', 'sidebar', 'sidebar_mini')),
        ];

        if (!$user->settings) {
            $user->settings()->create($settings);
        } else {
            $user->settings()->update($settings);
        }

        \Cache::flush();

        return back();
    }

    public function updateSettings(User $user, Request $request)
    {
        $this->validate($request, [
            'skin' => '', // exits in skins table
            'layout' => '', // exists in layouts table
            'mini' => 'boolean',
            'collapse' => 'boolean',
        ]);

        \Cache::flush();

        return $request->all();

        $user->settings = [
            'skin' => $request->skin,
            'layout' => $request->layout,
            'mini' => $request->mini,
            'collapse' => $request->collapse,
        ];
        $this->updateOrCreateSettings($user);

        return redirect()->back();
    }

    private function updateOrCreateSettings($user)
    {
        $user->app_setting()->count() > 0 ?
            event(new EditUserSettings($user)) :
            event(new CreateUserSettings($user));

        \Cache::flush();

        Cache::forget('user-navbar');
    }
}
