<?php

namespace App\Http\Traits;

use App\User;
use App\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

trait UsersTrait
{
    private function validateRequest($request, $user)
    {
        $this->validate($request, [
            'name' => 'required|unique:users,name,'.$user->id,
            'email' => 'required|email|unique:users,email,'.$user->id,
            'username' => 'required|unique:users,username,'.$user->id,
        ]);

        return $this;
    }

    private function sendEmail($user, $notify, $email_view, $subject = 'Welcome to Dainsys')
    {
        Mail::later(5, 'emails.'.$email_view, ['user'=>$user, 'password' => $this->random_password], function($email) use ($user, $notify, $subject){
            $email->to('yismen.jorge@ecco.com.do', 'Yismen Jorge')->subject($subject);
            if ($notify && config('app.env') == 'production') {
                $email->cc($user->email, $user->name);
            }
        });

        return $this;
    }

    private function createUser($user)
    {
        $user = $user->create([
            "name"      => $this->request->name,
            "email"     => $this->request->email,
            "username"  => $this->request->username,
            "password"  => Hash::make($this->random_password),
            "is_active" => $this->request->is_active,
            "is_admin"  => $this->request->is_admin
        ]);

        $this->syncRoles($user, $this->request->input('roles'))
            ->sendEmail($user, $this->request->notify, 'welcome', 'Welcome to Dainsys');

        return $this;
    }

    private function updateUser($user)
    {
        // dd($this->request->all());
        if ($user->id == auth()->user()->id && $this->request->is_active == 0) {
            session()->flash('danger', "You cant inactivate Your self. No changes made.");
            return $this;
        }
        // if ($user->id == auth()->user()->id && $this->request->is_admin == 1) {
        //     session()->flash('danger', "You cant set yourself as super admin. No changes.");
        //     return $this;
        // }
        $user->update($this->request->all());
            
        $this->syncRoles($user, $this->request->input('roles'));

        return $this;
    }

    /**
     * sync the roles model with the array selected by the user
     * 
     * @param  Menu   $menu  [description]
     * @param  Array  $roles [description]
     * @return [type]        [description]
     */
    public function syncRoles(User $user, Array $roles = null)
    {
        $user->roles()->sync((array) $roles);

        return $this;   
    }

    private function updatePassword($user)
    {
        $user->password = Hash::make($this->random_password);
        $user->save();

        $this->sendEmail($user, $this->request->notify, 'password-reset', 'Password Changed');

        return $this;
    }
}