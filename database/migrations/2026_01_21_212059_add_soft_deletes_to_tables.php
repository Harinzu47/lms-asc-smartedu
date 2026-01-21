<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * Add soft deletes to important tables for data safety.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('jadwals', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('materis', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('tugas', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('kelas', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('jadwals', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('materis', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('tugas', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('kelas', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
