<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Account;
use App\Models\User;
use App\Hady\Hady;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends ApiController
{
    public function __construct()
    {
        $this->middleware('jwt')->except(['login', 'forgotPassword', 'resetPassword']);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $data = Hady::login($request->input('email'), $request->input('password'));
        $data['currentUser']['permission'] = $this->getAccessControl()->getPermissions('ACCESS')->pluck('accessLevel', 'module');
        
        return response()->json($data);
    }

    public function logout(Request $request)
    {
        Hady::logout($request->bearerToken());

        return response()->noContent();
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'name' => 'required|string',
        ]);

        $request->merge(['password' => Hash::make($request->input('password'))]);

        $model = User::firstOrCreate(
            ['email' => $request->input('email')],
            $request->input()
        );

        return new Account($model);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'username' => 'required|email',
        ]);

        Hady::forgotPassword($request->input('username'));

        return response()->noContent();
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'jwtParam' => 'required',
            'newPassword' => 'required',
        ]);

        Hady::resetPassword($request->input('jwtParam'), Hash::make($request->input('newPassword')));

        return response()->noContent();
    }
}