<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

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
        
        $this->handleAuthenthication();

        if ($this->isOwnerOrAdmin()) {
            return $next($request);
        }

        $perms = $this->parsePerms($perms)
            ->handlePermsissions($perms);

        if ($this->reject) {
            return redirect("admin")
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
        return Auth::user()->hasRole('admin') 
            || Auth::user()->hasRole('owner');
    }

    private function handlePermsissions($perms)
    {
        if (! $perms) {
            return $this;
        }

        foreach ($perms as $key => $value) {
            if (Auth::user()->can($value)) {
                return $this;
            }            
        }
        return $this->reject("Unauthorized. Permission [$value] is required to view route ".$this->request->path());
    }

    /**
     * Convert the perms into an array of items.
     * @param   string $perms  The list of roles passed by the users
     * @return [type]         [description]
     */
    private function parsePerms($perms=null)
    {
        if ($perms) {
            $perms = explode("|", $perms);

            $perms = array_map(function($value){
                return trim($value);
            }, $perms);
        }

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
        if ($this->request->ajax()) {            
            return response($message, 401);
        }

        // I was unable to redirect from here. Had to set 
        // properties in order to redicrect from the 
        // handle method.
        $this->message = $message;
        return $this->reject = true;
    }
}
