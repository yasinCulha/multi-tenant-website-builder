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
            Schema::create('company_theme_settings', function (Blueprint $table) {
                $table->id();

                // Hangi firmaya ait olduğunu bağlıyoruz (companies tablonun ismine göre ayarla knk)
                $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
                
                // Aktif olarak seçtiği temanın id'si
                $table->foreignId('theme_id')->constrained('themes')->onDelete('cascade');

                $table->json('settings')->nullable();
                
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_theme_settings');
    }
};
