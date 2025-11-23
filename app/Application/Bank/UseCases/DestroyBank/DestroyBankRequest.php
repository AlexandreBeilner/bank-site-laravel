<?php

namespace App\Application\Bank\UseCases\DestroyBank;

final class DestroyBankRequest
{
    public function __construct(
        public int $id
    ) {}
}
