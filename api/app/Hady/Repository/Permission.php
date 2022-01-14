<?php

namespace App\Hady\Repository;

use App\Orenda\Interfaces\IRepository;
use App\Models\Permission as AppPermission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Permission implements IRepository
{
    private $related;
    private $attributes;

    public function __construct($related)
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
            'key' => ['required', 'string', 'unique:Permission,key'],
        ];

        $validator = Validator::make($this->attributes, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $this->related->key = strtolower(str_replace(' ', '-', $this->related->key));
        $this->related->save();
    }

    public function delete()
    {
        $this->related->delete();
    }

    public static function findOne($id)
    {
        return new self(AppPermission::where('id', $id)->firstOrFail());
    }
}
