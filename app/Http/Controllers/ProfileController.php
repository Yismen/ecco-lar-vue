<?php

namespace App\Http\Controllers;

use Image;
use App\User;
use App\Profile;
use Illuminate\Http\Request;
use App\Repositories\Profiles;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Repositories\ImageMaker;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        if (!$user->profile) {
            return redirect()->route('admin.profiles.create')
                ->withInfo('You have not created a profile, please create one now.');
        }

        $profile = $user->profile;

        $profiles = Cache::rememberForever('profiles', function () use ($user) {
            return Profile::
                with('user')
                ->whereHas('user', function ($query) {
                    return $query;
                })
                ->where('user_id', '<>', $user->id)
                ->paginate(18);
        });

        return view('profiles.show', compact('profile', 'profiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Profile $profile)
    {
        $user = auth()->user();

        if (auth()->user()->profile) {
            return redirect()->route('admin.profiles.index')
                ->withWarning('You have a profile already. What are you trying to do?');
        }
        $profile->name = $user->name;

        return view('profiles.create', compact('profile'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user, Image $img)
    {
        $this->validate($request, [
            'photo' => 'image|max:4000',
            'gender' => 'required',
            'name' => 'required|max:70',
            'bio' => 'max:4500',
            'phone' => 'max:50',
            'education' => 'max:1500',
            'skills' => 'max:300',
            'work' => 'max:1000',
            'location' => 'max:100',
        ]);

        $user = auth()->user();

        $user->name = $request->input('name');
        $user->save();

        $photoPath = $this->saveImage($request, $user);

        $user->profile()->create($request->all());

        Cache::forget('user-navbar');
        Cache::forget('profiles');

        if ($photoPath) {
            $user->profile->photo = $photoPath;
            $user->profile->save();
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => 1,
                'data' => $user
            ]);
        }

        return redirect()->route('admin.profiles.index')
            ->withSuccess('Your profile has been created...');
    }

    /**
     * show current user's profile
     * @param  Profile $profile current profile model
     * @return view           [description]
     */
    public function show(Profile $profile, Profiles $profiles)
    {
        $profiles = $profiles->all();

        return view('profiles.show', compact('profile', 'profiles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        if (!auth()->user()->owns($profile)) {
            return redirect()->route('admin.profiles.index')
                ->withWarning('Forbidden. You can only update your own profile!?');
        }

        $profile->name = $profile->user->name;

        return view('profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile, Image $img)
    {
        $this->validate($request, [
            'photo' => 'image|max:4000',
            'gender' => 'required',
            'name' => 'required|max:70',
            'bio' => 'max:4500',
            'phone' => 'max:50',
            'education' => 'max:1500',
            'skills' => 'max:300',
            'work' => 'max:1000',
            'location' => 'max:100',
        ]);

        $user = $profile->user;

        $user->name = $request->input('name');
        $user->save();

        $photoPath = $this->saveImage($request, $user);

        $profile->update($request->all());

        Cache::forget('user-navbar');
        Cache::forget('profiles');

        $profile->photo = $photoPath;
        $profile->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => 1,
                'data' => $user
            ]);
        }

        return redirect()->route('admin.profiles.index')
            ->withSuccess('Your profile has been updated...');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Methods
     */
    public function saveImage(Request $request, User $user)
    {
        /**
         * If not photo file passed, first we check if
         * the user is created already. If so we
         * return the actual photo, otherwise
         * we return null;
         */
        if (!$request->hasFile('photo')) {
            if ($user->profile) {
                return $user->profile->photo;
            }
            return null;
        };

        $this->validate($request, [
            'photo' => 'file|image|max:4000'
        ]);

        $path = "images/profiles/{$user->id}.png";

        Storage::drive('public')->put($path, ImageMaker::make($request->photo));

        return "storage/{$path}";
    }
}
