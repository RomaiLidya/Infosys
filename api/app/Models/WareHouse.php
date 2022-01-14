<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WareHouse extends Model
{
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    protected $table = 'WareHouse';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'address',
        'isDeleted',
        'deletedAt'
    ];
}
