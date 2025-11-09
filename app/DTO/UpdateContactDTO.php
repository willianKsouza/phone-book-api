<?php

namespace App\DTO;

class UpdateContactDTO
{
    public function __construct(
        public readonly int $contact_id,
        public readonly ?string $name = null,
        public readonly ?string $phone = null,
        public readonly ?string $email = null,
        public readonly ?string $avatar = null,
    ){}
}