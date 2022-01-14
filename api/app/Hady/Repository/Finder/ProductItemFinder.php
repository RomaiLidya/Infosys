<?php

namespace App\Hady\Repository\Finder;

use App\Orenda\Interfaces\IFinder;
use App\Models\ProductItem;

class ProductItemFinder implements IFinder
{
    private $query;
    private $page;

    public function __construct()
    {
        $this->query = ProductItem::select();
    }

    public function setKeyword($keyword)
    {
        if (!empty($keyword)) {
            $this->query->where(function ($query) use ($keyword) {
                $listKeyword = explode(' ', $keyword);
                $listKeyword = array_map('trim', $listKeyword);

                foreach ($listKeyword as $keyword) {
                    $pattern = '%' . $keyword . '%';
                    $columnList = [
                        'ProductId',
                    ];

                    foreach ($columnList as $x) {
                        $query->orWhere($x, "ILIKE", $pattern);
                    }
                }
            });
        }
    }

    public function withDelete()
    {
        $this->query->where('isDeleted', false);
    }

    public function get()
    {
        return $this->query->paginate(24);
    }

    public function orderBy($columnName, $orderBy)
    {
        $this->query->when($columnName, function ($query, $column) use ($orderBy) {
            return $query->orderBy($column, $orderBy);
        }, function ($query) {
            return $query->orderBy('id', 'desc');
        });
    }

    public function perPage($page)
    {
        $this->page = $page;
    }
}
