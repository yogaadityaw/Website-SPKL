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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id_user')->index()->autoIncrement();
            $table->string('user_nip')->unique();
            $table->string('user_fullname');
            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->string('user_telephone');
            $table->integer('user_age');
            $table->integer('role_id');
            $table->timestamps();

            $table->foreign('role_id')->references('id_role')->on('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
