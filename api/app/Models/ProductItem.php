<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    protected $table = 'ProductItem';

    protected $primaryKey = 'id';

    protected $fillable = [
        'ProductPackageId',
        'ProductId',
        'promoPrice',
        'minimumItem',
        'bonusItem',
        'isDeleted',
        'deletedAt',
    ];

    protected $guarded = [];

    protected $attributes = [
        'minimumItem' => 0,
        'isDeleted' => false,
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'ProductId');
    }

    public function productPackage()
    {
        return $this->hasOne(ProductPackage::class, 'id', 'ProductPackageId');
    }

}
