<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPackage extends Model
{
    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    protected $table = 'ProductPackage';

    protected $primaryKey = 'id';

    protected $fillable = [
        'ZoneId',
        'name',
        'image',
        'description',
        'totalPrice',
        'ProductId',
        'isDeleted',
        'deletedAt',
    ];

    protected $guarded = [];

    protected $attributes = [
        'description' => '',
        'totalPrice' => 0,
        'isDeleted' => false,
    ];

    public function productItems()
    {
        return $this->hasMany(ProductItem::class, 'ProductPackageId', 'id')->where('isDeleted', false);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductId', 'id');
    }

    public function zone()
    {
        return $this->hasOne(Zone::class, 'id','ZoneId');
    }
}
