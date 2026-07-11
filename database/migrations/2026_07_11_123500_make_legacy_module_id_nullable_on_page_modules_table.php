<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::connection()->getDriverName() === 'sqlite') {
            return;
        }

        DB::statement('ALTER TABLE page_modules MODIFY module_id BIGINT UNSIGNED NULL');
        DB::statement('ALTER TABLE page_modules MODIFY content JSON NULL');
    }

    public function down(): void
    {
        if (DB::connection()->getDriverName() === 'sqlite') {
            return;
        }

        DB::statement('ALTER TABLE page_modules MODIFY module_id BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE page_modules MODIFY content JSON NULL');
    }
};
