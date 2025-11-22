<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bank extends Model
{
    /** @use HasFactory<\Database\Factories\BankFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'interest_rate',
    ];

    public function billets(): HasMany
    {
        return $this->hasMany(Billet::class);
    }
}
