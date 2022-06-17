<?php

namespace App\Http\Resources\back;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AbandonedBasketCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    'id'      => $data->id,
                    'name' => $data->user->name,

                ];
            })
        ];
       }
}
