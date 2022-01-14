<?php
namespace App\Orenda;

use Illuminate\Validation\UnauthorizedException;
use Illuminate\Database\Eloquent\Model;
use App\Orenda\Interfaces\IAccessControl;

abstract class OAccessControl implements IAccessControl
{
    protected $model = null;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public abstract function hasAccess($module, $accessLevel);
    public abstract function hasAccesses($listName);

    public static function throwUnauthorizedException($message = null)
    {
        if(empty($message))
            $message = 'Anda tidak punya akses untuk aksi ini.';

        throw new UnauthorizedException($message);
    }
}