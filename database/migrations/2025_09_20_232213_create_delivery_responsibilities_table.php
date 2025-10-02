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
        Schema::create('delivery_responsibilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delivery_method_id')->constrained()->onDelete('cascade');
            $table->string('responsibility_type'); // enum buyer seller
            $table->json('responsibility_value'); // {"en": "Marine insurance", "tr": "Deniz sigortası", "de": "Seeversicherung"}
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index(
                ['delivery_method_id', 'responsibility_type'],
                'delivery_resp_type_idx'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_responsibilities');
    }
};
