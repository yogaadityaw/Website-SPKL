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
        Schema::create('q_r_codes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('spkl_id');
            $table->unsignedBigInteger('workshop_head_id');
            $table->unsignedBigInteger('department_head_id');
            $table->unsignedBigInteger('pt_head_id');
            $table->timestamps();

            $table->foreign('spkl_id')->references('id_spkl')->on('spkl');
            $table->foreign('workshop_head_id')->references('id_user')->on('users');
            $table->foreign('department_head_id')->references('id_user')->on('users');
            $table->foreign('pt_head_id')->references('id_user')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('q_r_codes');
    }
};
