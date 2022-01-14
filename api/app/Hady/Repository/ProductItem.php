<?php

namespace App\Hady\Repository;

use App\Orenda\Interfaces\IRepository;
use App\Models\ProductItem as AppProductItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductItem implements IRepository
{
    private $related;
    private $attributes;

    public function __construct($related = null)
    {
        $this->related = $related;
    }

    public function load($attributes)
    {
        $this->attributes = $attributes;
    }

    public function getModel()
    {
        return $this->related;
    }

    public function save()
    {
        $rules = [
            'ProductId' => ['required', 'integer'],
            'ProductPackageId' => ['required', 'integer'],
            'minimumItem' => ['integer'],
            'bonusItem' => ['integer']
        ];

        $validator = Validator::make($this->attributes, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $this->related->save();
    }

    public function delete()
    {
        $this->related->update(['isDeleted' => true, 'deletedAt' =>  date('Y-m-d H:i:s')]);
    }

    public static function findOne($id)
    {
        return new self(AppProductItem::where([['id', $id], ['isDeleted', false]])->firstOrFail());
    }
}
