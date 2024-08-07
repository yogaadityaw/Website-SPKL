<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('spkl', function (Blueprint $table) {
            $table->integer('id_spkl')->index()->autoIncrement();
            $table->integer('pt_id');
            $table->integer('proyek_id');
            $table->integer('bengkel_id');
            $table->string('ref_number');
            $table->string('spkl_number');
            $table->text('qr_code')->nullable();
            $table->string('uraian_pekerjaan');
            $table->string('pelaksanaan')->nullable();
            $table->string('progres')->nullable();
            $table->time('rencana_mulai')->default('00:00:00');
            $table->time('rencana_selesai')->default('00:00:00');
            $table->dateTime('tanggal');
            $table->boolean('is_kabeng_acc')->default(false);
            $table->boolean('is_departemen_acc')->default(false);
            $table->boolean('is_kemenpro_acc')->default(false);
            $table->enum('status', ['rejected', 'approved', 'process'])->default('process');
            $table->timestamps();

            $table->foreign('pt_id')->references('id_pt')->on('pt');
            $table->foreign('proyek_id')->references('id_proyek')->on('proyek');
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
