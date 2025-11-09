<?php

namespace App\Services;

use App\DTO\CreateContactDTO;
use App\DTO\GetAllContactDTO;
use App\Interfaces\ContactRepositoryInterface;
use App\Models\Contact;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FindContactService
{
    public function __construct(private ContactRepositoryInterface $contactRepositoryInterface)
    {}
    public function execute(string $id): Contact
    {
        $contacts = $this->contactRepositoryInterface->find($id);

        return $contacts;
    }
}
