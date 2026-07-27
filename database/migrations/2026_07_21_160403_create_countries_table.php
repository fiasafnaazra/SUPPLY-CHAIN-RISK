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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();

            $table->string('country_name');      // Nama Negara
            $table->string('country_code',5)->unique(); // Kode Negara (ID, MY, SG)
            $table->string('capital')->nullable(); // Ibu Kota
            $table->string('continent')->nullable(); // Benua
            $table->bigInteger('population')->nullable(); // Populasi
            $table->decimal('latitude',10,7)->nullable();
            $table->decimal('longitude',10,7)->nullable();
            $table->string('currency')->nullable(); // Mata Uang
            $table->string('flag')->nullable(); // URL atau nama file bendera

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};