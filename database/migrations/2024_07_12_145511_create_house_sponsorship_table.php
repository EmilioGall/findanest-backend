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
        Schema::create('house_sponsorship', function (Blueprint $table) {

            $table->date('expire_date');

            // Foreign key
            $table->unsignedBigInteger('house_id');
            $table->foreign('house_id')->references('id')->on('houses')->cascadeOnDelete();

            // Foreign key
            $table->unsignedBigInteger('sponsorship_id');
            $table->foreign('sponsorship_id')->references('id')->on('sponsorships')->cascadeOnDelete();

            // Unique index
            $table->unique(['house_id', 'sponsorship_id', 'expire_date']);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('house_sponsorship');
    }
};
