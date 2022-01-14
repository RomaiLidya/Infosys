<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    protected $table = 'ProductPrice';

    protected $primaryKey = 'id';

    protected $fillable = [
      'price',
      'ProductId',
      'ZoneId',
      'isDeleted',
      'deletedAt'
    ];

    public function zone()
    {
        return $this->hasOne(Zone::class, 'id', 'ZoneId');
    }

    public function product(){
      return $this->hasOne(Product::class, 'id', 'ProductId');
    }
}
