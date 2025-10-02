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
        Schema::create('product_delivery_methods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('delivery_method_id')->constrained()->onDelete('cascade');
            $table->decimal('additional_cost', 10, 2)->default(0); // 0.00, 50.00, 150.75
            $table->string('currency', 3)->default('USD'); // USD, EUR, TRY, GBP

            $table->string('availability_type')->nullable();  //['country', 'region', 'port', 'city', 'global']
            $table->string('location_code', 10)->nullable(); // TR, US, EU, WORLDWIDE
            $table->json('location_name')->nullable(); // {"en": "All countries with sea access", "tr": "Deniz erişimi olan tüm ülkeler"}
            $table->json('specific_details')->nullable(); // {"en": "Major international ports", "tr": "Büyük uluslararası limanlar"}

            $table->json('custom_notes')->nullable(); // {"en": "Express delivery available", "tr": "Hızlı teslimat mevcut"}
            $table->json('custom_attributes')->nullable(); // {"min_order_value": 1000, "free_shipping_over": 5000}
            $table->timestamps();
            

            $table->integer('estimated_days_min')->nullable(); // 5, 7, 10, 14
            $table->integer('estimated_days_max')->nullable(); // 14, 21, 30, 45


            $table->unique(['product_id', 'delivery_method_id']);
            $table->index('product_id');
            $table->index(['delivery_method_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_delivery_methods');
    }
};
