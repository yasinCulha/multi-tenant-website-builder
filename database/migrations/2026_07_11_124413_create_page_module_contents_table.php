<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('page_module_contents')) {
            return;
        }

        Schema::create('page_module_contents', function (Blueprint $table) {

            $table->id();

            $table->foreignId('page_module_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('field_key');

            $table->longText('field_value')
                ->nullable();

            $table->timestamps();

            $table->unique([
                'page_module_id',
                'field_key'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_module_contents');
    }
};
