<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ComputationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return[

            'student_id'=> $this->student_id,
            'subject_code'=> $this->subject_code,
            'total_score'=> $this->total_score,
        ];
    }
    public function with($request) {
        return[
            'version' => '1.0.0',
            'author_url' => url ('http://tijjbbas1.com')
        ];
}
}