<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('fasilitas', function (Blueprint $table) {
            // Menambahkan kolom ENUM dengan dua nilai
            $table->enum('kategori', ['AKADEMIK', 'NON_AKADEMIK'])
                ->default('AKADEMIK')
                ->after('nama'); // Diletakkan setelah kolom 'nama'
        });
    }

    public function down(): void
    {
        Schema::table('fasilitas', function (Blueprint $table) {
            // Menghapus kolom saat rollback
            $table->dropColumn('kategori');
        });
    }
};
