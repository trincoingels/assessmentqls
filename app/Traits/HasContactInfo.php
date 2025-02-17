<?php

namespace App\Traits;

trait HasContactInfo
{
    public function getContactInfo(object $data): array
    {
        return [
            'name' => $data->name ?? null,
            'companyname' => $data->companyname ?? null,
            'street' => $data->street ?? null,
            'housenumber' => $data->housenumber ?? null,
            'address2' => $data->address2 ?? null,
            'postalcode' => $data->zipcode ?? null,
            'locality' => $data->city ?? null,
            'country' => $data->country ?? null,
            'email' => $data->email ?? null,
            'phone' => $data->phone ?? null,
            'vat' => $data->vat ?? null,
            'eori' => $data->eori ?? null,
            'oss' => $data->oss ?? null
        ];
    }
}
