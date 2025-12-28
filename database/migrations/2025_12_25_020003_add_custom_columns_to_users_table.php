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
            $table->enum('role', ['admin', 'tutor', 'siswa'])->default('siswa')->after('password');
            $table->string('nomor_telepon')->nullable()->after('role');
            $table->text('alamat')->nullable()->after('nomor_telepon');
            $table->boolean('status_aktif')->default(false)->after('alamat'); // Default false untuk siswa baru
            $table->string('bukti_pembayaran')->nullable()->after('status_aktif'); // Path file gambar bukti transfer
            $table->foreignId('kelas_id')->nullable()->after('bukti_pembayaran')->constrained('kelas')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['kelas_id']);
            $table->dropColumn([
                'role',
                'nomor_telepon',
                'alamat',
                'status_aktif',
                'bukti_pembayaran',
                'kelas_id'
            ]);
        });
    }
};
