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

            //foreign key
            $table->unsignedBigInteger('house_id');
            $table->foreign('house_id')->references('id')->on('houses')->cascadeOnDelete();

            //foreign key
            $table->unsignedBigInteger('sponsorship_id');
            $table->foreign('sponsorship_id')->references('id')->on('sponsorships')->cascadeOnDelete();

            //primary key
            $table->primary(['house_id', 'sponsorship_id']);

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
