<?php

namespace App\Http\Controllers\Api;

use App\Hady\Repository\Finder\UserFinder;
use App\Hady\Repository\User as RepositoryUser;
use App\Http\Controllers\Controller;
use App\Http\Resources\User as ResourcesUser;
use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiUserController extends Controller
{
    public function index(Request $request): ResourceCollection
    {
        $user = new UserFinder();

        if ($request->has('keyword')) {
            $user->setKeyword($request->query('keyword'));
        }

        if($request->has('name')){
            $user->setName($request->query('name'));
        }

        if ($request->has('typeUser')) {
            $user->setTypeUser($request->query('typeUser'));
        }

        if ($request->has('delete')) {
            $user->setDelete($request->query('delete'));
        }

        if ($request->has('perPage')) {
            $user->perPage($request->query('perPage'));
        }

        if ($request->has('orderBy') && $request->has('ordered')) {
            $user->orderBy($request->query('orderBy'), $request->query('ordered'));
        } else {
            $user->orderBy('id', 'desc');
        }

        $data = $user->get();
        return new UserCollection($data);
    }

    public function show($id): JsonResource
    {
        return new ResourcesUser(RepositoryUser::findOne($id)->getModel());
    }

    public function store(Request $request): JsonResource
    {
        $user = User::findOrNew($request->id);
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->email = $request->email;
        $user->loginName = $request->email;
        $user->contactNumber = $request->contactNumber;
        $user->pin = $request->pin;
        $user->typeUser = $request->typeUser;

        if ($request->has('password')) {
            $user->password = $request->password;
        }

        $model = new RepositoryUser($user);
        $model->load($request->input());
        $model->save();

        return new ResourcesUser($model->getModel());
    }

    public function destroy($id)
    {
        RepositoryUser::findOne($id)->delete();
        return response()->noContent();
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'string|required|min:6',
        ]);

        $model = User::findOrFail(Auth::user()->id);
        
        $model->password = Hash::make($request->input('password'));
        if($model->isNew){
            $model->isNew = false;
        }
        $model->save();

        return new ResourcesUser($model);
    }

    public function validationPassword(Request $request)
    {
        $request->validate([
            'pin' => ['required', 'string'],
        ]);

        return response()->json([
            'data' => [
                'validation' => User::where('pin', $request->input('pin'))->exists(),
            ],
        ]);
    }
}
