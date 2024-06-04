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
        Schema::table('spkl', function (Blueprint $table) {
            $table->string('alasan_penolakan')->nullable();

            $table->boolean('is_departemen_acc')->nullable()->change();
            $table->boolean('is_kemenpro_acc')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spkl', function (Blueprint $table) {
            //
        });
    }
};
