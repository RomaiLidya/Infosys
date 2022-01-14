<?php

namespace App\Hady\Repository;

use App\Models\Category;
use App\Models\LogActivity;
use App\Orenda\Interfaces\IRepository;
use App\Models\Product as AppProduct;
use App\Models\ProductImages;
use App\Models\ProductPrice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class Product implements IRepository
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
        $isExists = $this->related->exists;
        $productChange = $this->related->isDirty();
        $rules = [
            'productName' => ['required', 'string'],
            'purchasePrice' => ['required', 'integer'],
            'CategoryId' => ['required', 'integer'],
            'typeUnit' => ['string', 'required'],
            'productCode' => ['required', 'string', Rule::unique('Product', 'productCode')->where('isDeleted', 'false')],
            'price' => ['array'],
        ];

        if ($isExists) {
            $rules['productCode'] = ['required', 'string', Rule::unique('Product', 'productCode')->ignore($this->related->id)];
        }

        $validator = Validator::make($this->attributes, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $oldValue = AppProduct::find($this->related->id);
        $this->related->save();

        if (!empty($this->attributes['image'])) {
            $this->related->productImages()->createMany($this->attributes['image']);
        }

        if (!empty($this->attributes['price'])) {
            foreach ($this->attributes['price'] as $price) {
                
               $_price = ProductPrice::findOrNew($price['id']);
               $_price->ProductId = $this->related->id;
               $_price->ZoneId = $price['ZoneId'];
               $_price->price = $price['price'];
               $oldPrice = ProductPrice::find($_price->id);
               $hasChange = $_price->isDirty();
               $_price->save();
               
               if($isExists){
                    if($hasChange){
                        LogActivity::create([
                            'initial' => 'ProductPrice',
                            'action' => $_price->exists ? 'UPDATE' : 'CREATE',
                            'description' =>  'Memperbaharui harga produk ' . $this->related->name,
                            'createdBy' => Auth::user()->id,
                            'oldValue' => $_price->exists ? json_encode($oldPrice) : null,
                            'newValue' => json_encode($_price),
                        ]);
                    }
               }
            }
        }


        if($productChange){
            LogActivity::create([
                'initial' => 'Product',
                'action' => $isExists ? 'UPDATE' : 'CREATE',
                'description' =>  ($isExists ?  'Memperbaharui produk ' : 'Menambah produk ') . $this->related->name,
                'createdBy' => Auth::user()->id,
                'oldValue' => $isExists ? json_encode($oldValue) : null,
                'newValue' => json_encode($this->related),
            ]);
        }
    }

    public function delete()
    {
        $this->related->update(['isDeleted' => true, 'deletedAt' =>  date('Y-m-d H:i:s')]);
        LogActivity::create([
            'initial' => 'Product',
            'action' => 'DELETE',
            'description' =>  'Menghapus produk ' . $this->related->name,
            'createdBy' => Auth::user()->id,
        ]);
    }

    public static function deleteImage($id)
    {
        ProductImages::destroy($id);
        LogActivity::create([
            'initial' => 'Product',
            'action' => 'DELETE',
            'description' =>  'Menghapus gambar produk ',
            'createdBy' => Auth::user()->id,
        ]);
    }

    public static function productChangeStockProductPackage($productId, $value)
    {
        AppProduct::where('id', $productId)->decrement('holdItem', $value);
        AppProduct::where('id', $productId)->decrement('totalStock', $value);
    }

    public static function productChangeStockNonProductPackage($productId, $value)
    {
        AppProduct::where('id', $productId)->decrement('holdItem', $value);
        AppProduct::where('id', $productId)->decrement('totalStock', $value);
    }

    public static function findOne($id)
    {
        return new self(AppProduct::where([['id', $id], ['isDeleted', false]])->firstOrFail());
    }

    public static function getCode($id)
    {
        $count = AppProduct::where('CategoryId', $id)->count();
        $category = Category::find($id);

        return $category->code; //sprintf('%04d', ($count + 1));
    }
}


