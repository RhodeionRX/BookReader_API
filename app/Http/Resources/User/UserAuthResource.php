<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => [
                'id' => $this->id,
                'login' => $this->login,
                'nickname' => $this->nickname,
                'email' => $this->email,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'is_archived' => $this->when(isset($this->deleted_at), function () {
                    return true;
                }, false),
            ],
            'token' => $this->token,
        ];
    }
}
