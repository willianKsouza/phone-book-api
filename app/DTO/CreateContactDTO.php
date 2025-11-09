<?php

namespace App\DTO;

class CreateContactDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $phone,
        public readonly string $email,
        public readonly string $avatar,
    ){}
}
