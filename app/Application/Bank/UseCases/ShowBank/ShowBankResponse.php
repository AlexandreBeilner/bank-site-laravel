<?php

namespace App\Application\Bank\UseCases\ShowBank;

use App\Models\Bank;

final class ShowBankResponse
{
    public function __construct(
        public readonly ?Bank $bank = null,
    ){}
}
