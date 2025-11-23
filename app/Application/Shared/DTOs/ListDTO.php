<?php

namespace App\Application\Shared\DTOs;

class ListDTO
{
    public function __construct(
        public ?string $search = null,
        public int $page,
        public int $perPage,
        public string $orderBy,
        public string $direction
    ){}
}
