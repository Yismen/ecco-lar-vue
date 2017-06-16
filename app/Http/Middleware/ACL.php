<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ACL
{
    /**
     * Laravel Request Object.
     */
    private $request;
    /**
     * Laravel Next Clousure.
     */
    private $next;
    private $user;
    /**
     * If set to true, the current request will be rejected.
     */
    private $reject;
    /**
     * The message to be displayed when a request is rejected.
     */
    private $message;
    /**
     * Permissions object parsed from the string given by the request.
     */
    private $perms;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $perms=null)
    {
        $this->request = $request;
        $this->next = $next;
        $this->perms = $perms;
        $this->user = Auth::user();
        
        $this->handleAuthenthication();

        // if ($this->isOwnerOrAdmin()) return $next($request);

        $this->parsePerms()
            ->handlePermsissions();

        if ($this->reject) {
            if ($this->request->ajax()) {            
                return response($this->message, 401);
            }
            
            return redirect()
                ->back()
                ->withImportat(true)
                ->withDanger($this->message);
        }

        return $next($request);
    }

    /**
     * Check if the user is authenticated.
     *     
     * @return object Current class.
     */
    private function handleAuthenthication()
    {
         if (Auth::guest()) {
            if ($this->request->ajax() || $this->request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                // return redirect()->guest('admin/login');
                return redirect()->guest('login');
            }
        }

        return $this;
    }   

    /**
     * Checks wether the user has admin or owner roles
     * @return boolean [description]
     */
    private function isOwnerOrAdmin()
    {
        return $this->user->hasRole('admin') 
            || $this->user->hasRole('owner');
    }

    private function handlePermsissions()
    {
        $perms = $this->perms;
        if (! $perms) {
            return $this;
        }

        foreach ($perms as $permission) {
            if ($this->user->can($permission)) {
                return $this;
            }            
        }

        Log::error(
            'User '. $this->user->name. ' was denied to access route ['.
            $this->request->path().
            '] because missing required permission ['.$permission.'].'
        );

        return $this->reject(
            "Unauthorized. Permission [$permission] is required to view route ".
            $this->request->path().". Contact Site Admin."
        );
    }

    /**
     * Convert the perms into an array of items.
     * @param   string $perms  The list of roles passed by the users
     * @return [type]         [description]
     */
    private function parsePerms()
    {
        $perms = $this->perms;

        if (! $perms) {
            return;
        }

        $perms = explode("|", $this->perms);

        $perms = array_map(function($value){
            return trim($value);
        }, $perms);

        $this->perms = $perms;

        return $this;
    }

    /**
     * Reject the unauthorized request.
     *                 
     * @param  string $message [description]
     * @return [type]          [description]
     */
    private function reject($message="Unauthorized.")
    {
        // I was unable to redirect from here. Had to set 
        // properties in order to redicrect from the 
        // handle method.
        $this->message = $message;
        return $this->reject = true;
    }
}
