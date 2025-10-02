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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->string('cas_number', 12);
            $table->json('description');
            $table->json('packaging')->nullable();
            $table->boolean('editors_choice')->default(false);

            
            $table->foreignId('country_id')->constrained('countries')->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('delivery_info_id')->nullable()->constrained('delivery_infos')->cascadeOnDelete();

            $table->string('name_az')->storedAs("JSON_UNQUOTE(JSON_EXTRACT(`name`, '$.az'))");
            $table->index('name_az', 'idx_name_az');

            $table->string('name_en')->storedAs("JSON_UNQUOTE(JSON_EXTRACT(`name`, '$.en'))");
            $table->index('name_en', 'idx_name_en');

            $table->string('name_tr')->storedAs("JSON_UNQUOTE(JSON_EXTRACT(`name`, '$.tr'))");
            $table->index('name_tr', 'idx_name_tr');

            $table->string('name_ru')->storedAs("JSON_UNQUOTE(JSON_EXTRACT(`name`, '$.ru'))");
            $table->index('name_ru', 'idx_name_ru');

            $table->string('name_zhcn')->storedAs("JSON_UNQUOTE(JSON_EXTRACT(`name`, '$.zhcn'))");
            $table->index('name_zhcn', 'idx_name_zhcn');  //zh-CN  chi 普通话 / Pǔtōnghuà


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
