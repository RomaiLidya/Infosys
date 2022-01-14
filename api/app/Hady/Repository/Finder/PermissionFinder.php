<?php

namespace App\Hady\Repository\Finder;

use App\Hady\Hady;
use App\Orenda\Interfaces\IFinder;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Permission;

class PermissionFinder implements IFinder
{
    private $query;
    private $page;

    public function __construct()
    {
        $this->query = Permission::select();
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
                        'module',
                        'accessLevel',
                        'id',
                    ];

                    foreach ($columnList as $x) {
                        $query->orWhereRaw("lower($x) LIKE ?", [$pattern]);
                    }
                }
            });
        }
    }

    public function get()
    {
        $result = null;
        switch($this->page) {
            case 'all':
                $rows = $this->query->get();
                $n = max(1, count($rows)); // Prevent to divined by zero

                $result = new LengthAwarePaginator($rows, $n, $n);
                break;

            default:
                $result = $this->query->paginate(Hady::getPaginate());
                break;
        }

        return $result;
    }

    public function orderBy($columnName, $orderBy)
    {
        $this->query->when($columnName, function ($query, $column) use ($orderBy) {
            return $query->orderBy($column, $orderBy);
        }, function ($query) {
            return $query->orderBy('id');
        });
    }

    public function perPage($page)
    {
        $this->page = $page;
    }
}
