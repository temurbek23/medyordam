<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CallHistoryResource extends JsonResource
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
			'doctor_id' => $this->doctor_id,
			'patient_id' => $this->patient_id,
			'duration' => $this->duration,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at
        ];
    }
}
