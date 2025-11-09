<?php

namespace App\Services;

use App\DTO\CreateContactDTO;
use App\DTO\GetAllContactDTO;
use App\Interfaces\ContactRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GetAllContactsService
{
    public function __construct(private ContactRepositoryInterface $contactRepositoryInterface)
    {}
    public function execute(GetAllContactDTO $dto): LengthAwarePaginator
    {
        $contacts = $this->contactRepositoryInterface->getAll($dto);
        return $contacts;
    }
}
