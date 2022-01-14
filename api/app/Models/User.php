<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    const CREATED_AT = 'createdAt';
    const UPDATED_AT = 'updatedAt';

    protected $table = 'User';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'contactNumber',
        'loginName',
        'email',
        'password',
        'isActive',
        'roleId',
        'type',
        'pin',
        'isNew',
        'isDeleted',
        'deletedAt',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $attributes = [
        'isActive' => true,
        'isDeleted' => false,
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function generateApiToken($token)
    {
        $user = self::findOrFail(Auth::user()->id);

        return [
            'token' => $token,
            'currentUser' => [
                'id' => $user->id,
                'firstName' => $user->firstName,
                'lastName' => $user->lastName,
                'contactNumber' => $user->contactNumber,
                'permission' => $user->permission,
                'email' => $user->email,
                'pin' => $user->pin,
                'isNew' => $user->isNew,
                'roleId' => $user->roleId,
                'type' => $user->typeUser
            ]
        ];
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class, 'SalesId', 'id');
    }

 

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'roleId');
    }
}
