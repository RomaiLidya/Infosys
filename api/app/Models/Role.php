<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    protected $table = 'Role';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'label',
        'notes',
        'group_by',
    ];

    protected $guarded = [];

    public function permissions()
    {
        return $this->hasMany(RolePermission::class, 'RoleId', 'id');
    }
}
