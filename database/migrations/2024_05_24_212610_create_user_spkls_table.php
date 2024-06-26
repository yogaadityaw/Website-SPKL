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
            $table->text('jam_realisasi')->nullable();
            $table->text('lokasi_check_in')->nullable();
            $table->text('lokasi_check_out')->nullable();
            $table->string('foto_check_in')->nullable();
            $table->string('foto_check_out')->nullable();
            $table->dateTime('check_in')->nullable();
            $table->dateTime('check_out')->nullable();
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
