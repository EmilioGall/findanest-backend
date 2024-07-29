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
        Schema::create('views', function (Blueprint $table) {
            $table->id(); // ID univoco per ogni visualizzazione
            $table->bigInteger('ip_address'); // Indirizzo IP dell'utente
            $table->unsignedBigInteger('house_id'); // Chiave esterna per la tabella houses
            $table->date('view_date'); // Data della visualizzazione
            $table->timestamps(); // Timestamp per created_at e updated_at

            // Chiave esterna per la tabella houses
            $table->foreign('house_id')
                ->references('id')
                ->on('houses')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('views');
    }
};
