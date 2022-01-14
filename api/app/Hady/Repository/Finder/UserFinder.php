<?php

namespace App\Hady\Repository\Finder;

use App\Hady\Hady;
use App\Orenda\Interfaces\IFinder;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserFinder implements IFinder
{
    private $query;
    private $page;

    public function __construct()
    {
        $this->query = User::select();
        $this->query->where('isDeleted', false);

        if (Auth::user()->typeUser === 'ADMIN') {
            $this->query->whereIn('typeUser', ['SALES', 'SUPERVISOR', 'DRIVER']);
        }
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
                        'firstName',
                        'lastName',
                        'id',
                        'contactNumber',
                    ];

                    foreach ($columnList as $x) {
                        $query->orWhere($x, "ILIKE", $pattern);
                    }
                }
            });
        }
    }

    public function setName($value)
    {
        $this->query->where('firstName', 'ILIKE', "%$value%")->orWhere('lastName', 'ILIKE', "%$value%");
    }

    public function setDelete($value)
    {
        $this->query->where('isDeleted', $value ?? false);
    }

    public function setTypeUser($type)
    {
        $this->query->where('typeUser', $type);
    }

    public function get()
    {
        // var_dump($this->query->toSql()); die;
        return $this->query->paginate($this->page ?? Hady::getPaginate());
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
