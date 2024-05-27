<?php

namespace App\Http\Resources\Book;

use App\Http\Resources\User\UserResource;
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
            'created_by' => $this->when(
                isset($this->creator), function () {
                    return UserResource::make($this->creator);
                },
                $this->created_by
            ),
            'updated_by' => $this->when(
                isset($this->updater), function () {
                return UserResource::make($this->updater);
            },
                $this->updated_by
            ),
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
