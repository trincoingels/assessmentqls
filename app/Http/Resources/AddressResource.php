<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'companyname' => $this->company,
            'street' => $this->street,
            'housenumber' => $this->housenumber,
            'address2' => $this->address2,
            'postalcode' => $this->postalcode,
            'locality' => $this->locality,
            'country' => $this->country,
            'email' => $this->email,
            'phone' => $this->phone,
            'vat' => $this->vat,
            'eori' => $this->eori,
            'oss' => $this->oss,
        ];
    }
}
