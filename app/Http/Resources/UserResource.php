<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name, 
            'departemen' => $this->seksi->departemen->departemen,
            'seksi' => $this->seksi->seksi,
            'created_at'=>$this->created_at,
            'update_at'=>$this->updated_at,
            
            ];
    }
}
