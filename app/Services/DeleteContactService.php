<?php

namespace App\Services;

use App\Interfaces\ContactRepositoryInterface;
use App\Models\Contact;

class DeleteContactService
{
    public function __construct(private ContactRepositoryInterface $contactRepositoryInterface) {}

    public function execute(string $id): Contact
    {
        $contact = $this->contactRepositoryInterface->delete($id);

        return $contact;
    }
}
