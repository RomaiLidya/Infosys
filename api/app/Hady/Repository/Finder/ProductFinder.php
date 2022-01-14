<?php

namespace App\Hady\Repository\Finder;

use App\Orenda\Interfaces\IFinder;
use App\Models\Product;

class ProductFinder implements IFinder
{
    private $query;
    private $page;

    public function __construct()
    {
        $this->query = Product::select();
    }

    public function setKeyword($keyword)
    {
        $this->query->where('productName', 'ILIKE', "%{$keyword}%");
    }

    public function withDelete()
    {
        $this->query->where('Product.isDeleted', false);
    }

    public function setCategory($id)
    {
        $this->query->where('CategoryId', $id);
    }

    public function withRoutePrice($route)
    {
    }

    public function withWarehouse($id)
    {
        $this->query->where('WareHouseId', $id);
    }

    public function setIsProductPackage($isPackage)
    {
        $this->query->where('isProductPackage', $isPackage);
    }

    public function withReturn()
    {
        $this->query->where('Product.totalReturn', '>', 0);
    }

    public function withDamage()
    {
        $this->query->where('totalDamage', '!=', 0);
    }

    public function get()
    {
        return $this->query->paginate(24);
    }

    public function orderBy($columnName, $orderBy)
    {
        $this->query->when($columnName, function ($query, $column) use ($orderBy) {
            $query->orderBy('Product.' . $column, $orderBy);
        }, function ($query) {
            $query->orderBy('Product.id', 'asc');
        });
    }

    public function perPage($page)
    {
        $this->page = $page;
    }
}
