<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Billet extends Model
{
    /** @use HasFactory<\Database\Factories\BilletFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'payer_name',
        'payer_document',
        'recipient_name',
        'recipient_document',
        'amount',
        'expiration_date',
        'observations',
        'customer_id',
        'bank_id',
    ];

    protected $casts = [
        'expiration_date' => 'date',
        'amount' => 'decimal:2',
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
}
