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
        Schema::table('users', function (Blueprint $table) {
            // add surname and date_of_birth columns
            $table->string('surname')->after('name')->nullable();
            $table->date('date_of_birth')->after('surname')->nullable();

            // set name as nullable and add unique
            $table->string('name')->nullable()->change();
            $table->unique('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // drop surname and date_of_birth columns
            $table->dropColumn('surname');
            $table->dropColumn('date_of_birth');

            // unset name as nullable and remove unique
            $table->string('name')->nullable(false)->change();
            $table->dropUnique(['name']);
        });
    }
};
