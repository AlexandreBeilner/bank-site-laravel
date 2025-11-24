<?php

namespace App\Jobs;

use App\Domain\Billing\Repositories\BillingInstallmentRepository;
use App\Domain\Billing\Repositories\BillingServiceRepository;
use App\Mail\BillingInstallmentsMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendBillingInstallmentsMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(
        BillingInstallmentRepository $billingInstallmentRepository,
        BillingServiceRepository $billingServiceRepository,
    ): void {
        $today = now()->toDateString();

        $installments = $billingInstallmentRepository->findPendingForDate($today);

        $grouped = $installments->groupBy('billing_service_id');

        foreach ($grouped as $serviceId => $group) {
            $service  = $billingServiceRepository->findById($serviceId);
            $customer = $service->customer;

            Mail::to($customer->email)
                ->queue(new BillingInstallmentsMail($service, $group));

            $billingInstallmentRepository->markAsSent($group->pluck('id')->all());
        }
    }
}
