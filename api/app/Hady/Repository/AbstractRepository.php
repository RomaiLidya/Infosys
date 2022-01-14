<?php
namespace App\Hady\Repository;

use Illuminate\Validation\Validator;
use Illuminate\Validation\ValidationException;

use Illuminate\Database\Eloquent\Model;

class AbstractRepository
{
    protected $model = null;
    
    // List of validators
    private $validators = [];

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->validators = [];
    }

    public function getModel()
    {
        return $this->model;
    }

    public function delete()
    {
        $this->model->delete();
    }

    // Do validate
    public function validate()
    {
        foreach($this->validators as $x) {
            self::validOrThrow($x);
        }
    }

    public static function validOrThrow(Validator $validator)
    {
        // Validate the input and return correct response
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    public function addValidator(Validator $validator)
    {
        $this->validators[] = $validator;
    }

    public function save()
    {
        $this->validate();

        $this->model->save();
    }
}
