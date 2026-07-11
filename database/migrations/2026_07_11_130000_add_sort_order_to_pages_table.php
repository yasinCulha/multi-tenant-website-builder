<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->integer('sort_order')->default(10)->after('slug');
        });

        DB::table('pages')
            ->orderBy('company_id')
            ->orderBy('id')
            ->get()
            ->groupBy('company_id')
            ->each(function ($pages) {
                $pages->values()->each(function ($page, int $index) {
                    DB::table('pages')
                        ->where('id', $page->id)
                        ->update(['sort_order' => ($index + 1) * 10]);
                });
            });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });
    }
};
