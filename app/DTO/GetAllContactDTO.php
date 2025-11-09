<?php

namespace App\DTO;

class GetAllContactDTO
{
    public function __construct(
        public readonly ?int $page = 1,
        public readonly ?int $per_page = 15,
        public readonly ?string $name = null,
        public readonly ?string $phone = null,
        public readonly ?string $email = null,
    ) {}
}
