<?php

namespace App\Application\Billet\UseCases\CreateBillet;

final class CreateBilletRequest
{
    public function __construct(
        public string $payer_name,
        public string $payer_document,
        public string $recipient_name,
        public string $recipient_document,
        public float $amount,
        public string $expiration_date,
        public ?string $observations,
        public int $customer_id,
        public int $bank_id,
    ) {}
}
