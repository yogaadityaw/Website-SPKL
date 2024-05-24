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
            $table->integer('spkl_id')->nullable();
            $table->integer('workshop_head_id')->nullable();
            $table->integer('department_head_id')->nullable();
            $table->integer('pj_proyek_id')->nullable();
            $table->text('workshop_head_qr_code')->nullable();
            $table->text('department_head_qr_code')->nullable();
            $table->text('pj_proyek_qr_code')->nullable();
            $table->timestamps();

            $table->foreign('spkl_id')->references('id_spkl')->on('spkl');
            $table->foreign('workshop_head_id')->references('id_user')->on('users');
            $table->foreign('department_head_id')->references('id_user')->on('users');
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
