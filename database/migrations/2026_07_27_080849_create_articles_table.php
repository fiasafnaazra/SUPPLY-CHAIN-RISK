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
        Schema::create('articles', function (Blueprint $table) {

            $table->id();

            $table->string('title');

            // Negara yang berkaitan dengan artikel
            $table->string('country_code');

            // Tingkat risiko
            $table->enum('risk_level', [
                'Low',
                'Medium',
                'High'
            ]);

            // Ringkasan artikel
            $table->text('summary');

            // Isi artikel
            $table->longText('content');

            // Nama file gambar
            $table->string('image')->nullable();

            // Tanggal publikasi
            $table->date('published_at');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};