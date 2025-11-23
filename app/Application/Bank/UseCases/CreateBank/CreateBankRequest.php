<?php

namespace App\Application\Bank\UseCases\CreateBank;

final class CreateBankRequest
{
    public function __construct(
        public string $name,
        public string $code,
        public float $interest_rate,
    ) {}
}
