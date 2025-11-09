<?php

namespace App\Services;

use App\DTO\CreateContactDTO;
use App\DTO\GetAllContactDTO;
use App\DTO\UpdateContactDTO;
use App\Interfaces\ContactRepositoryInterface;
use App\Models\Contact;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UpdateContactService
{
    public function __construct(private ContactRepositoryInterface $contactRepositoryInterface)
    {}
    public function execute(UpdateContactDTO $dto): Contact
    {
        $contacts = $this->contactRepositoryInterface->update($dto);

        return $contacts;
    }
}
