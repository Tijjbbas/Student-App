<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       // return parent::toArray($request);

       return[

        'id'=> $this->id,
        'name'=> $this->name,
        'class'=> $this->class,
        'age' => $this->age,
        'sex'=> $this->sex,
        'date_of_birth'=> $this->date_of_birth,
        'entry_year'=> $this->entry_year,
        'email_address'=> $this->email_address,
        'religion'=> $this->religion,
        'phone_number'=> $this->phone_number,
        'photo'=> $this->photo,
       ];
    }
    public function with($request) {
        return[
            'version' => '1.0.0',
            'author_url' => url ('http://tijjbbas1.com')
        ];
    }


}
