<?php

namespace App\DTO;

class GetAllContactDTO
{
    public function __construct(
        public readonly ?int $page = 1,
        public readonly ?int $per_page = 15,
        public readonly ?string $field = null,
        public readonly ?string $value = null,

    ) {}
}
