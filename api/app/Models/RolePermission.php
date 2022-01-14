<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $table = 'RolePermission';

    protected $primaryKey = 'id';

    protected $fillable = [
        'RoleId',
        'PermissionId',
    ];

    protected $guarded = [];

    public $timestamps = false;

    public function permission()
    {
      return $this->hasOne(Permission::class, 'id', 'PermissionId');
    }
}
