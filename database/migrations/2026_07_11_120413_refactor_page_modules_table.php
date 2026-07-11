<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::connection()->getDriverName() !== 'sqlite') {
            DB::statement('ALTER TABLE page_modules MODIFY module_id BIGINT UNSIGNED NULL');
            DB::statement('ALTER TABLE page_modules MODIFY content JSON NULL');
        }

        Schema::table('page_modules', function (Blueprint $table) {

            $table->foreignId('theme_page_module_id')
                ->nullable()
                ->after('page_id')
                ->constrained('theme_page_modules')
                ->cascadeOnDelete();

        });

        if (!Schema::hasTable('page_module_contents')) {
            Schema::create('page_module_contents', function (Blueprint $table) {
                $table->id();
                $table->foreignId('page_module_id')
                    ->constrained()
                    ->cascadeOnDelete();
                $table->string('field_key');
                $table->text('field_value')->nullable();
                $table->timestamps();

                $table->unique(['page_module_id', 'field_key']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('page_module_contents');

        Schema::table('page_modules', function (Blueprint $table) {

            $table->dropConstrainedForeignId('theme_page_module_id');

        });

        if (DB::connection()->getDriverName() !== 'sqlite') {
            DB::statement('ALTER TABLE page_modules MODIFY module_id BIGINT UNSIGNED NOT NULL');
        }
    }
};
