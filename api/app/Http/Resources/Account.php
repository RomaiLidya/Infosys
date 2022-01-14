<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class Account extends JsonResource
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
            'contactNumber' => $this->contactNumber,
            'permission' => $this->permission,
            'email' => $this->email,
            'pin' => $this->pin,
            'SalesRoute' => $this->SalesRoute,
            'isNew' => $this->isNew,
            'type' => $this->typeUser,
        ];
    }
}
