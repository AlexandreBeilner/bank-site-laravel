<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillingService extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'description',
        'customer_id',
        'bank_id',
        'total_amount',
        'installments',
        'first_due_date',
        'periodicity',
    ];

    protected $casts = [
        'first_due_date' => 'date',
        'total_amount' => 'decimal:2',
    ];

    protected $dates = ['deleted_at'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }


    public function billingInstallment(): HasMany
    {
        return $this->hasMany(BillingInstallment::class);
    }
}
