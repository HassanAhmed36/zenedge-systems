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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('merchant_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->string('customer_name');
            $table->decimal('amount', 8, 2)->unsigned();
            $table->decimal('remaining_amount', 8, 2)->unsigned();
            $table->integer('source')->unsigned();
            $table->integer('type')->unsigned();
            $table->decimal('tax', 5, 2)->unsigned();
            $table->string('invoice_code')->unique(); // Alphanumeric random unique number
            $table->string('invoice_url')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
