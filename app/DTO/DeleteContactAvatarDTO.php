<?php

namespace App\DTO;
use Illuminate\Http\UploadedFile;

class DeleteContactAvatarDTO
{
    public function __construct(
        public readonly string $directory,
        public readonly ?string $file_name = null,
    ){}
}
