<?php
namespace App\Hady\Repository;

use App\Orenda\OAccessControl;
use App\Models\RolePermission;

class AccessControl extends OAccessControl
{
    protected $model = null;
    private $permission = [];

    public function __construct($model)
    {
        $this->model = $model;
        $this->permission = $this->getPermissions();
    }

    public function getPermissions($access = NULL)
    {
        $list = RolePermission::join('Permission', 'RolePermission.PermissionId', '=', 'Permission.id')
            ->join('Role', 'Role.id', '=', 'RolePermission.RoleId')
            ->join('User', 'User.roleId','=','Role.id')
            ->where('User.roleId', $this->model->roleId)
            ->orderBy('Permission.module', 'asc');
            
        if ($access) {
            $list = $list->where('accessLevel', $access);
        }

        return $list->get();
    }

    public function hasAccess($module, $accessLevel)
    {
        $access = explode(',', $accessLevel);

        if ($this->permission->where('module', 'ADMINISTRATION')->where('accessLevel', 'ACCESS')->first()) {
            return !empty($this->permission->where('module', 'ADMINISTRATION')->where('accessLevel', 'ACCESS')->first());
        }

        return !empty($this->permission->where('module', $module)->whereIn('accessLevel', $access)->all());
    }

    public function hasAccesses($listName)
    {
        $isHasAccess = $this->permission;
        foreach ($listName as $x) {
            $isHasAccess->where('name', $x);
        }

        return !empty($isHasAccess);
    }
}
