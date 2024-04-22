<?php

namespace App\Http\Resources\Book;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'is_archived' => $this->when(
                isset($this->deleted_at), function () {
                return true;
            }, false),
            'details' => BookDetailsResource::collection(
                $this->whenLoaded('details')
            )
        ];
    }
}
