<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    /** @use HasFactory<\Database\Factories\BankFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'interest_rate',
    ];

    protected $dates = ['deleted_at'];

    public function billets(): HasMany
    {
        return $this->hasMany(Billet::class);
    }

    public function billings(): HasMany
    {
        return $this->hasMany(BillingService::class);
    }
}
