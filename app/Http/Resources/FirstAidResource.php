<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FirstAidResource extends JsonResource
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
			'case' => $this->case,
			'photo' => $this->photo,
			'treatment' => $this->treatment,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at
        ];
    }
}
