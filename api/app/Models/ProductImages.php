<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    protected $table = 'ProductImages';

    protected $primaryKey = 'id';

    protected $fillable = [
        'path',
        'ProductId',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
