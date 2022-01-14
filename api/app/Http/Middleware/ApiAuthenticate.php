<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Illuminate\Validation\ValidationException;
use Validator;
use Auth;
use App\Orenda\JsonResponse;
use App\Models\User;
use App\Reseller;
use App\Hady\Repository\AccessControl;

class ApiAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $jsonResponse = new JsonResponse();
    
        try {
            $module = $this->checkModule($request->route());
            $accessLevel = $this->checkAccessLevel($request->route());

            $this->authenticate($request->bearerToken(), $module, $accessLevel);
        } catch(ValidationException $e) {
            $jsonResponse->setError(true);
            $jsonResponse->setMessage('Token tidak dikirim');
            $jsonResponse->setStatus(401);

            return $jsonResponse->getResponse();;
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            $jsonResponse->setError(true);
            $jsonResponse->setMessage($e->getStatusCode());
            $jsonResponse->setStatus(401);
            
            return $jsonResponse->getResponse();;
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            
            $jsonResponse->setError(true);
            $jsonResponse->setMessage($e->getStatusCode());
            $jsonResponse->setStatus(401);

            return $jsonResponse->getResponse();;
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            
            $jsonResponse->setError(true);
            $jsonResponse->setMessage($e->getStatusCode());
            $jsonResponse->setStatus(401);

            return $jsonResponse->getResponse();;
        }

        return $next($request);
    }

    protected function checkModule($route)
    {
        $actions = $route->getAction();
        
        return isset($actions['module']) ? $actions['module'] : null;
    }

    protected function checkAccessLevel($route)
    {
        $actions = $route->getAction();

        return isset($actions['accessLevel']) ? $actions['accessLevel'] : null;
    }

    /**
     * Determine if the user is logged in to any of the given guards.
     *
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function authenticate($apiToken, $module, $accessLevel)
    {
        $fields = [
            'api_token' => $apiToken,
        ];

        $rules = array(
            'api_token' => 'required'
        );

        $validator = Validator::make($fields, $rules);

        // Validate input
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $payload = JWTAuth::parseToken()->getPayload();

        // Validate if api token is valid
        $user = User::where('id', $payload->get('sub'))->first();

        if(empty($user)) {
            throw new \Exception('API TOKEN tidak valid!');
        }
        
        $accessControl = new AccessControl($user);

        // Validate if api roles menu not allowed
        if($accessLevel !== 'BYPASS' && empty($accessControl->hasAccess($module, $accessLevel))) {
            throw new \Exception('Anda tidak punya akses ' . $accessLevel . ' pada menu ini!, ' . $module);
        }

        Auth::login($user);
    }
}
