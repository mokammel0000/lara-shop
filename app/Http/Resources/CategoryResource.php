<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        // return parent::toArray($request);
        // this is the DEFAULT, returning all data

        return [
            'id' => $this->id,     // this is belongs to the Category object that it will be in it...
            'name' => $this->name,
            // 'my_name' => $this->name,

            'icon' => $this->when($request->filter == 'icon', $this->icon),
            'photo' => $this->when($request->filter == 'photo', $this->photo),
        ];

    }
}
