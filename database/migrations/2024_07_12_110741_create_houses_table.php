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
            $table->decimal('price', 10, 2);
            $table->string('address'); 
            $table->text('description')->nullable();
            $table->integer('rooms');
            $table->integer('beds');
            $table->integer('bathrooms');
            $table->integer('sqm');
            $table->double('latitude', 15, 8);
            $table->double('longitude', 15, 8);
            $table->string('image')->nullable();
            $table->boolean('visible')->default(1);
            $table->string('slug')->unique();
            $table->boolean('sponsored')->default(0);

            $table->timestamps();

            //foreign key
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            
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
