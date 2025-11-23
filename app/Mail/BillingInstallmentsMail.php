<?php

namespace App\Mail;

use App\Models\BillingService;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class BillingInstallmentsMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        private readonly BillingService $billingService,
        private readonly Collection $installments
    )
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Billing Installments Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.billing.installments',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

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
