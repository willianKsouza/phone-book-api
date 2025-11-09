<?php

namespace App\Services;

use App\DTO\DeleteContactAvatarDTO;
use App\Repositories\ContactRepository;
use Illuminate\Contracts\Filesystem\Filesystem;

class DeleteContactAvatarService
{
    public function __construct(private Filesystem $storage, private ContactRepository $contactRepository) {}

    public function execute(DeleteContactAvatarDTO $dto): string
    {
        $path = "{$dto->directory}/" . $dto->file_name;

        return $this->storage->delete($path);
    }
}
