<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'name' => $this->name,
            'headline' => $this->headline,
            'bio' => $this->bio,
            'photo' => $this->photo,
            'email' => $this->email,
            'github' => $this->github,
            'linkedin' => $this->linkedin,
            'instagram' => $this->instagram,
            'cv_url' => $this->cv_url,
        ];
    }
}
