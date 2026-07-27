<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news_caches', function (Blueprint $table) {

            $table->id();

            $table->string('country_code');

            $table->string('title');

            $table->text('description')->nullable();

            $table->string('source')->nullable();

            $table->string('url')->nullable();

            $table->string('image')->nullable();

            $table->dateTime('published_at')->nullable();

            $table->string('category')->nullable();

            $table->string('sentiment')->nullable();

            $table->integer('sentiment_score')->default(0);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news_caches');
    }
};