<?php

namespace App\Application\Billet\UseCases\ShowBillet;

use App\Models\Billet;

final class ShowBilletResponse
{
    public function __construct(
        public readonly ?Billet $billet = null,
    ){}
}
