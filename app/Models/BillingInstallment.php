<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillingInstallment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'billing_service_id',
        'number',
        'amount',
        'due_date'
    ];

    protected $casts = [
        'due_date' => 'date',
        'amount' => 'decimal:2',
    ];

    protected $dates = ['deleted_at'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(BillingService::class);
    }
}
