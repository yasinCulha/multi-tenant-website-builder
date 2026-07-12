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
        if (Schema::hasTable('theme_page_module_fields')) {
            return;
        }

        Schema::create('theme_page_module_fields', function (Blueprint $table) {
            $table->id();

            // Her kayit bir tema modulunun Builder'da editlenebilir alanini tanimlar.
            $table->foreignId('theme_page_module_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('field_key');

            $table->string('field_name');

            $table->string('type');

            $table->string('placeholder')->nullable();

            $table->text('default_value')->nullable();

            $table->integer('sort_order')->default(0);

            $table->boolean('is_required')->default(false);

            $table->timestamps();

            $table->unique(['theme_page_module_id', 'field_key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theme_page_module_fields');
    }
};
