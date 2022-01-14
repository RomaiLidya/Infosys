<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    protected $table = 'Category';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'code', 'description', 'isDeleted', 'deletedAt',
    ];

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
