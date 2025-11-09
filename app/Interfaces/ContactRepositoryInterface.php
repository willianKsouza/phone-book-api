<?php

namespace App\Interfaces;

use App\DTO\CreateContactDTO;
use App\DTO\GetAllContactDTO;
use App\DTO\UpdateContactDTO;
use App\Models\Contact;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ContactRepositoryInterface {
    public function getAll(GetAllContactDTO $dto): LengthAwarePaginator;
    public function create(CreateContactDTO $dto): Contact;
    public function find(string $id): Contact;
    public function update(UpdateContactDTO $dto): Contact;
    public function delete(string $id): Contact;
}