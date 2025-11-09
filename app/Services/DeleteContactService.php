<?php

namespace App\Services;

use App\DTO\DeleteContactAvatarDTO;
use App\Interfaces\ContactRepositoryInterface;
use App\Models\Contact;

class DeleteContactService
{
    public function __construct(
        private ContactRepositoryInterface $contactRepositoryInterface,
        private DeleteContactAvatarService $deleteContactAvatarService,
    ) {}

    public function execute(string $id): Contact
    {
        $contact = $this->contactRepositoryInterface->delete($id);

            $dto = new DeleteContactAvatarDTO(
                'avatars',
                $contact->getRawOriginal('avatar'),
            );
            $this->deleteContactAvatarService->execute($dto);
     

        return $contact;
    }
}
