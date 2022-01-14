<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    protected $table = 'Permission';

    protected $primaryKey = 'id';

    protected $fillable = ['module', 'accessLevel'];

    protected $guarded = [];

    protected $attributes = ['module', 'accessLevel'];

    public function rolePermission()
    {
        return $this->belongsTo(RolePermission::class);
    }
}
