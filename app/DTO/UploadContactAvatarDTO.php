<?php

namespace App\DTO;
use Illuminate\Http\UploadedFile;

class UploadContactAvatarDTO
{
    public function __construct(
        public readonly string $directory,
        public readonly UploadedFile $file,
    ){}
}
