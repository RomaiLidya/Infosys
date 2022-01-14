<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Account;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ApiAccountController extends ApiController
{
    public function __construct()
    {
        $this->middleware('jwt');
    }

    public function show(): JsonResource
    {
        $data = Auth::user()->toArray();
        $data['permission'] = $this->getAccessControl()->getPermissions('ACCESS')->pluck('accessLevel', 'module');
        return new Account((object) $data);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'newPassword' => 'string|required|min:6',
            'currentPassword' => [
                'string',
                'required',
                'min:6',
                function ($attribute, $value, $fail) {
                    $user = User::find(Auth::user()->id);

                    if (!Hash::check($value, $user->password)) {
                        $fail($attribute . ' password is invalid ');
                    }
                },
            ],
        ]);

        $model = User::find(Auth::user()->id);
        $model->password = Hash::make($request->input('newPassword'));
        $model->save();

        return response()->noContent();
    }
}
