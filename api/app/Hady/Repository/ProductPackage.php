<?php

namespace App\Hady\Repository;

use App\Orenda\Interfaces\IRepository;
use App\Models\ProductItem;
use App\Models\ProductPackage as AppProductPackage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductPackage implements IRepository
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
            'name' => ['required', 'string'],
            'ZoneId' => ['required', 'integer'],
            'ProductId' => ['required', 'integer'],
            'items' => ['required'],
            'totalPrice' => ['required']
        ];

        if ($this->related->exists) {
            unset($rules['items']);
        }

        $validator = Validator::make($this->attributes, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        DB::beginTransaction();
        try {
            $this->related->save();

            if (isset($this->attributes['items'])) {
                foreach ($this->attributes['items'] as $items) {
                    $item = ProductItem::findOrNew($items['id']);
                    $item->ProductPackageId = $this->related->id;
                    $item->ProductId = $items['ProductId'];
                    $item->minimumItem = $items['minimumItem'];
                    $item->promoPrice = $items['promoPrice'];
                    $item->bonusItem = $items['bonusItem'];

                    if (isset($items['isDeleted'])) {
                        $item->isDeleted = true;
                        $item->deletedAt = date('Y-m-d H:i:s');
                    }

                    $item->save();
                }
            }

            DB::commit();
        } catch (\Illuminate\Database\QueryException$e) {
            DB::rollBack();
        }
    }

    public function delete()
    {
        $this->related->update(['isDeleted' => true, 'deletedAt' => date('Y-m-d H:i:s')]);
    }

    public static function findOne($id)
    {
        return new self(AppProductPackage::where([['id', $id], ['isDeleted', false]])->firstOrFail());
    }
}
