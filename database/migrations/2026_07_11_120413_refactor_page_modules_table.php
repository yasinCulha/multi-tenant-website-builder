<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('page_modules', function (Blueprint $table) {

            $table->foreignId('theme_page_module_id')
                ->nullable()
                ->after('page_id')
                ->constrained('theme_page_modules')
                ->cascadeOnDelete();

        });
    }

    public function down(): void
    {
        Schema::table('page_modules', function (Blueprint $table) {

            $table->dropConstrainedForeignId('theme_page_module_id');

        });
    }
};