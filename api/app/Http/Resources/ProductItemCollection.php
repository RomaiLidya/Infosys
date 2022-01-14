<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductItemCollection extends ResourceCollection
{
    public $collects = ProductItem::class;
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $request->is('api/package/item/*') ? ['data' => $this->collection] : $this->collection;
    }
}
