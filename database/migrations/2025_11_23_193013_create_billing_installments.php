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
        Schema::create('billing_installments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('billing_service_id')->constrained('billing_services');
            $table->unsignedInteger('number');
            $table->decimal('amount', 15, 2);
            $table->date('due_date');
            $table->timestamp('email_sent_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_installments');
    }
};
