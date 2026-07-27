<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ports', function (Blueprint $table) {

            $table->id();

            $table->string('port_name');
            $table->string('alternate_name')->nullable();

            // Menyimpan nama negara dari dataset World Port Index
            $table->string('country_code', 100)->index();

            $table->string('region')->nullable();

            $table->string('water_body')->nullable();

            $table->decimal('latitude', 10, 6);

            $table->decimal('longitude', 10, 6);

            $table->string('harbor_type')->nullable();

            $table->string('harbor_size')->nullable();

            $table->string('harbor_use')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ports');
    }
};