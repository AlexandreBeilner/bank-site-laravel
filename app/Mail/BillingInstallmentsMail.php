<?php

namespace App\Mail;

use App\Models\BillingService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class BillingInstallmentsMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        private readonly BillingService $billingService,
        private readonly Collection $installments
    ) {}

    public function build(): self
    {
        return $this
            ->subject('Parcelas do serviço de cobrança: ' . $this->billingService->description)
            ->markdown('emails.billing.installments', [
                'service' => $this->billingService,
                'installments' => $this->installments,
                'customer' => $this->billingService->customer,
            ]);
    }
}
