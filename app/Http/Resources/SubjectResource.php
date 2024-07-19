<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
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
        'subject_name'=> $this->subject_name,
        'subject_code'=> $this->subject_code,
       ];
    }
    public function with($request) {
        return[
            'version' => '1.0.0',
            'author_url' => url ('http://tijjbbas1.com')
        ];
    }


}
