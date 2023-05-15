<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SesionResource extends JsonResource
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
            'id'         => $this->id,
            'duracion'     => $this->duracion,
            'id_curso'      => new CursoResource($this->id_curso),
            'fecha'       => $this->fecha,
        ];
    }
}