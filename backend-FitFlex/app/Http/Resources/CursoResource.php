<?php


namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;


class CursoResource extends JsonResource
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
           'titulo'       => $this->titulo,
           'description'=> $this->description,
           'filepath'       => $this->filepath,
           'modalidad'   => $this->modalidad,
           'duracion'  => $this->duracion,
       ];
   }
}
