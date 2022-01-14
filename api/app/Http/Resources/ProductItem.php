<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductItem extends JsonResource
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
            'minimumItem' => $this->minimumItem,
            'bonusItem' => $this->bonusItem,
            'ProductId' => $this->ProductId,
            'promoPrice' => $this->promoPrice,
            'Product' => new Product($this->product),
            $this->mergeWhen($request->is('api/package/item/*'), [
                'ProductPackage' => new ProductPackage($this->productPackage),
            ]),
        ];
    }
}
