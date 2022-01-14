<?php

namespace App\Hady\Repository;

use App\Orenda\Interfaces\IRepository;
use App\Models\Role;
use App\Models\User as AppUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class User extends AbstractRepository implements IRepository
{
    private $related;
    private $attributes;

    public function __construct($related = null)
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
            'firstName' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('User', 'email')->ignore($this->related->id)],
            'contactNumber' => ['required', 'string', 'min:8', Rule::unique('User', 'contactNumber')->ignore($this->related->id)],
        ];

        $messages = [
            'firstName.required' => 'Firstname harus diisi',
            'email.required' => 'Email harus diisi',
            'contactNumber.required' => 'Contact Number harus diisi',
            'contactNumber.min' => 'Contact Number minimum 8 karakter',
        ];

        $validator = Validator::make($this->attributes, $rules, $messages);

        self::validOrThrow($validator);

        if (isset($this->attributes['password'])) {
            $this->related->password = Hash::make($this->related->password);
        }

        $this->related->roleId = (Role::where('label', $this->related->typeUser)->first())->id;
        $this->related->save();

        
    }

    public function savePassword()
    {
        $model = $this->related;

        $validator = Validator::make($this->attributes, [
            'newPassword' => 'string|required|min:6',
            'currentPassword' => [
                'string',
                'required',
                'min:6',
                function ($attribute, $value, $fail) use ($model) {
                    if (!Hash::check($value, $model->password)) {
                        $fail($attribute . ' password is invalid ');
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $model->password = Hash::make($this->attributes['newPassword']);
        $model->save();
    }

    public function delete()
    {
        $this->related->update(['isDeleted' => true, 'deletedAt' =>  date('Y-m-d H:i:s')]);
    }

    public static function findOne($id)
    {
        return new self(AppUser::where([['id', $id], ['isDeleted', false]])->firstOrFail());
    }
}
