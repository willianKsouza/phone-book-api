<?php

namespace App\Services;

use App\DTO\UploadContactAvatarDTO;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Str;

class UploadContactAvatarService
{
    public function __construct(private Filesystem $storage) {}

    public function execute(UploadContactAvatarDTO $dto): ?string
    {
        $file_name = Str::ulid().'.'.$dto->file->extension();

        $this->storage->putFileAs($dto->directory, $dto->file, $file_name);

        return $file_name;

    }
}
