<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductPackage extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'totalPrice' => (int) $this->totalPrice,
            'description' => $this->description,
            'image' => $this->image,
            'Zone' => new Zone($this->zone),
            $this->mergeWhen($this->product->isProductPackage, [
                'ProductItem' => new ProductItemCollection($this->productItems),
            ]),
        ];
    }
}
