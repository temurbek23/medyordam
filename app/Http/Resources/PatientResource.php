<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
			'firstname' => $this->firstname,
			'lastname' => $this->lastname,
			'password' => $this->password,
			'email' => $this->email,
			'contact' => $this->contact,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at
        ];
    }
}
