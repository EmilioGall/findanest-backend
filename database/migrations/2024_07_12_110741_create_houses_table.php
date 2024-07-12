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
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->decimal('price');
            $table->text('address')->unique();
            $table->text('description')->nullable();
            $table->integer('rooms');
            $table->integer('bathrooms');
            $table->integer('sqm');
            $table->float('latitude')->unique();
            $table->float('longitude')->unique();
            $table->string('image')->nullable();
            $table->boolean('visible')->default('true');
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('houses');
    }
};
