<?php

namespace App\Http\Controllers\Api;

use App\Hady\Repository\Finder\PermissionFinder;
use App\Hady\Repository\Permission as RepositoryPermission;
use App\Hady\Repository\RolePermission as RepositoryRolePermission;
use App\Http\Controllers\Controller;
use App\Http\Resources\Permission as ResourcesPermission;
use App\Http\Resources\RolePermission as ResourcesRolePermission;
use App\Http\Resources\PermissionCollection;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Http\Request;

class ApiPermissionController extends Controller
{
    public function index(Request $request)
    {
        $finder = new PermissionFinder();
        if ($request->has('keyword')) {
            $finder->setKeyword($request->query('keyword'));
        }

        if ($request->has('perPage')) {
            $finder->perPage($request->query('perPage'));
        }

        if ($request->has('orderBy') && $request->has('ordered')) {
            $finder->orderBy($request->query('orderBy'), $request->query('ordered'));
        }

        $data = $finder->get();
        
        return new PermissionCollection($data);
    }

    public function show($id)
    {
        return new ResourcesPermission(RepositoryPermission::findOne($id)->getModel());
    }

    public function store(Request $request)
    {
        $permission = Permission::findOrNew($request->id);
        $permission->key = $request->key;
        $permission->notes = $request->notes;

        $repo = new RepositoryPermission($permission);
        $repo->load($request->input());
        $repo->save();

        return new ResourcesPermission($repo->getModel());
    }

    public function setPermission(Request $request)
    {
        $rolePermission = RolePermission::firstOrCreate(['UserId' => $request->UserId, 'PermissionId' => $request->PermissionId]);
        $rolePermission->UserId = $request->UserId;
        $rolePermission->PermissionId = $request->PermissionId;

        $repo = new RepositoryRolePermission($rolePermission);
        $repo->load($request->input());
        $repo->save();
        
        return new ResourcesRolePermission($repo->getModel());
    }

    public function getPermission($id)
    {
        return new ResourcesRolePermission(RepositoryRolePermission::findWithUserId($id)->getModel());
    }

    public function destroyPermission(Request $request)
    {
        RolePermission::where(['UserId' => $request->UserId])->delete();

        return response()->noContent();
    }


    public function destroy($id)
    {
        RepositoryPermission::findOne($id)->delete();
        return response()->noContent();
    }
}
