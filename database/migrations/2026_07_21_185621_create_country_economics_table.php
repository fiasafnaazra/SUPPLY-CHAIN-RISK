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
        Schema::create('country_economics', function (Blueprint $table) {
    $table->id();

    $table->string('country_code');
    $table->year('year')->nullable();

    $table->decimal('gdp',20,2)->nullable();
    $table->decimal('inflation',10,2)->nullable();
    $table->bigInteger('population')->nullable();
    $table->decimal('export',20,2)->nullable();
    $table->decimal('import',20,2)->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('country_economics');
    }
};
