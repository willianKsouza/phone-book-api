<?php

namespace App\Services;

use App\DTO\CreateContactDTO;
use App\Interfaces\ContactRepositoryInterface;
use App\Models\Contact;

class CreateContactService
{
    public function __construct(private ContactRepositoryInterface $contactRepositoryInterface)
    {}

    public function execute(CreateContactDTO $dto): Contact
    {
        $contact = $this->contactRepositoryInterface->create($dto);

        return $contact;
    }
}
