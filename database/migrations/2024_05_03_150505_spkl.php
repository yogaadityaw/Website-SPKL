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
        Schema::create('spkl', function (Blueprint $table) {
            $table->integer('id_spkl')->index()->autoIncrement();
            $table->string('spkl_number');
            $table->string('uraian_pekerjaan');
            $table->string('rencana');
            $table->string('pelaksanaan');
            $table->dateTime('tanggal');
            $table->integer('jam_realisasi')->nullable();
            $table->enum('status', ['Reject', 'Pending', 'Approve'])->default('Pending');
            $table->integer('pt_id');
            $table->integer('proyek_id');   
            $table->integer('departemen_id');
            $table->integer('bengkel_id');
            $table->boolean('is_kabeng_acc')->default(false);
            $table->boolean('is_departemen_acc')->default(false);
            $table->boolean('is_kemenpro_acc')->default(false);
            $table->timestamps();

            $table->foreign('pt_id')->references('id_pt')->on('pt');
            $table->foreign('proyek_id')->references('id_proyek')->on('proyek');
            $table->foreign('departemen_id')->references('id_departemen')->on('departemen');
            $table->foreign('bengkel_id')->references('id_bengkel')->on('bengkel');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spkl');
    }
};
