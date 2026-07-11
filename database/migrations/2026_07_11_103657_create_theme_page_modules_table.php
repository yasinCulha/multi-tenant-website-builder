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
        Schema::create('theme_page_modules', function (Blueprint $table) {
           $table->id();

        $table->foreignId('theme_page_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->string('name');

        $table->string('view_path');

        $table->string('icon')
            ->nullable();

        $table->integer('order')
            ->default(10);

        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theme_page_modules');
    }
};
