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
        Schema::create('user_spkls', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('spkl_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id_user')->on('users');
            $table->foreign('spkl_id')->references('id_spkl')->on('spkl');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_spkls');
    }
};
