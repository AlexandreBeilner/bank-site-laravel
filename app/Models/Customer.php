<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
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
