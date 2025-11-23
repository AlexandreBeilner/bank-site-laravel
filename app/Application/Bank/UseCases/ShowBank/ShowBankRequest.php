<?php

namespace App\Application\Bank\UseCases\ShowBank;

final class ShowBankRequest
{
    public function __construct(
        public int $id
    ){}
}
