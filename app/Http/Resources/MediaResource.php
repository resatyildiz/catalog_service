<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => (string)$this->id,
            "attributes" => [
                "name" => $this->name,
                "path" => $this->path,
                "type" => $this->type,
                "size" => $this->size,
                "extension" => $this->extension,
                "mime_type" => $this->mime_type,
                "url" => $this->url,
                "disk" => $this->disk,
                "directory" => $this->directory,
                "filename" => $this->filename,
                "created_at" => $this->created_at,
                "updated_at" => $this->updated_at
            ]
        ];
    }
}
