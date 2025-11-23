<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('billing_services', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->foreignId('customer_id')->constrained()->restrictOnDelete();
            $table->foreignId('bank_id')->constrained()->restrictOnDelete();
            $table->decimal('total_amount', 15, 2);
            $table->integer('installments');
            $table->date('first_due_date');
            $table->string('periodicity')->default('monthly');;
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_services');
    }
};
