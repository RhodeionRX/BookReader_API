<?php

namespace App\Http\Resources;

use App\Models\BookLocalInfo;
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
            'localizations' => BookLocalizationResource::collection(
                $this->whenLoaded('localizations')
            )
        ];
    }
}
