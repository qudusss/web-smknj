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
        Schema::table('pengumuman', function (Blueprint $table) {
            // Menambahkan kolom 'published_at' sebagai DATETIME, 
            // dan boleh NULL karena pengumuman bisa di-draft tanpa tanggal terbit.
            // Diletakkan setelah kolom 'is_published' (jika ada)
            $table->dateTime('published_at')->nullable()->after('is_published');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengumuman', function (Blueprint $table) {
            // Menghapus kolom 'published_at' saat migrasi di-rollback
            $table->dropColumn('published_at');
        });
    }
};
