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
        Schema::create('delivery_methods', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->string('expansion'); // bu code tablosunda yazilan CIF ve ya FOB ve ya benzeri kodlarin acilim
            $table->json('description');
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index(['sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_methods');
    }
};
