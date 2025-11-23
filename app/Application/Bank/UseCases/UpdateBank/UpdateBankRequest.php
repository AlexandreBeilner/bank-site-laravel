<?php

namespace App\Application\Bank\UseCases\UpdateBank;

final class UpdateBankRequest
{
    public function __construct(
        public int $id,
        public string $name,
        public string $code,
        public float $interest_rate,
    ) {}
}
