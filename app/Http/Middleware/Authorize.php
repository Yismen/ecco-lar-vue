<?php 

namespace App\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Routing\Route;
use Closure;

class Authorize {

    protected $roles = null;
    protected $permissions = null;

    public function __construct(Guard $auth, Route $route)
    {
        // dd($route);
        $this->auth = $auth;
        $this->roles = $this->getRequiredRoles($route);
        $this->permissions = $this->getRequiredPermissions($route);        
    }

	/**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
	public function handle($request, Closure $next)
	{     
		// if ($this->auth->guest())
		// {
  //           if ($request->ajax()) {
  //               return response('Unauthorized.', 401);
  //           } else {
  //               return redirect()
  //                   ->guest('auth/login')
  //                   ->withWarning('Please Log in');
  //           }
		// }

		if ( ! $this->isOwnerOrAdmin() ) {

            if( $this->roles) {

                return $this->analiceWithRole($request, $next);

            } elseif ($this->permissions) {

                return $this->analiceWithPerms($request, $next);

            }  

	    }

        return $next($request);

	}

    /**
     * Checks wether the user has admin or owner roles
     * @return boolean [description]
     */
    private function isOwnerOrAdmin()
    {
        return $this->auth->user()->hasRole('admin') 
            || $this->auth->user()->hasRole('owner');
    }

    /**
     * Check if current route is attached to a role or array or roles
     * @param  [object] $route [routes object]
     * @return [type]        [description]
     */
    private function getRequiredRoles($route)
    {
        return isset($route->getAction()['roles']) ? 
            $route->getAction()['roles'] :
            null;
    }

    /**
     * Check if current route is attached to a role or array or roles
     * @param  [object] $route [routes object]
     * @return [type]        [description]
     */
    private function getRequiredPermissions($route)
    {
        return isset($route->getAction()['permissions']) ? 
            $route->getAction()['permissions'] : 
            null;
    }


    /**
     * Analiza si el usuario autentificado
     * tiene el rol(es) solicitado en la ruta
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return \Illuminate\Http\RedirectResponse
     */
    private function analiceWithRole($request, $next)
    {
        if($this->auth->user()->hasRole($this->roles))
        {
            if($this->permissions)
            {
                return $this->analiceWithPerms($request, $next);
            }

            return $next($request);

        } else {

            if ($request->ajax()) {

                return response('Unauthorized.', 401);

            } else {

                return redirect()->back(302)
                    ->withWarning(
                        'You dont have the role to view page.'.
                        $request->route()->getUri()
                    );

            }
        }
    }

    /**
     * Analiza si el usuario autentificado
     * tiene los permisos solicitados
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return \Illuminate\Http\RedirectResponse
     */
    private function analiceWithPerms($request, $next)
    {
        if($this->auth->user()->can($this->permissions)) {

            return $next($request);

        } else {            

            if ($request->ajax()) {

                return response('Unauthorized.', 401);

            } else {

                return redirect()->back(302)
                    ->withWarning(
                        "You dont have the permissions to access route - ".
                        $request->route()->getUri()
                    );

            }
        }
    }

}