<?php

namespace App\Http\Resources;

use App\Hady\Repository\AccessControl;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'name' => $this->firstName . ' ' . $this->lastName,
            'contactNumber' => $this->contactNumber,
            'loginName' => $this->loginName,
            'email' => $this->email,
            'isActive' => $this->isActive,
            'type' => $this->typeUser,           
            'roleId' => $this->roleId,
            $this->mergeWhen($request->is('api/users/*'), [
                'Commission' => new CommissionCollection($this->commissions),
            ]),
            'SalesRoute' => new SalesRouteCollection($this->salesRoutes),
            $this->mergeWhen($request->has('newUser'), [
                'permission' => (new AccessControl($this))->getPermissions('ACCESS')->pluck('accessLevel', 'module')    
            ])
        ];
    }
}
