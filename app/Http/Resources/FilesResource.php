<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FilesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $filePath = storage_path('app/public') . '/' . $this->photo;

        return [ 
            'id' => $this->id,
            'name' => $this->name,
            'title' => $this->title,
            'description' => $this->description,
            'file_type' => pathinfo($filePath),
            'file_size' => filesize($filePath),
            'path' => $this->photo,
        ];
    }
}
