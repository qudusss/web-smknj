<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Carbon\Carbon;

class PengumumanSMKController extends Controller
{
    /**
     * Menampilkan daftar pengumuman di website utama.
     * Mendukung searching dan pagination.
     */
    public function index(Request $request)
    {
        $now = Carbon::now();

        // 1. Inisialisasi Query Dasar (Filter Publikasi)
        $query = Pengumuman::query()
            ->where('is_published', true); // Filter Wajib: Status Terbit ON

        // 2. Filter Waktu (Mengatasi masalah NULL)
        $query->where(function ($q) use ($now) {
            // Tampilkan jika Tanggal Terbit NULL (tidak dijadwalkan)
            $q->whereNull('published_at')
                // ATAU jika waktu terbit sudah lewat
                ->orWhere('published_at', '<=', $now);
        });

        // 3. Logika Pencarian (Search)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            // Mencari di kolom 'title' atau 'content'
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%');
            });
        }

        // 4. Eksekusi Query, Ordering, dan Pagination
        // KOREKSI UTAMA: Variabel harus bernama $pengumumans
        $pengumumans = $query->orderBy('published_at', 'desc')
            ->paginate(6) // Menggunakan 6 item per halaman
            ->withQueryString();

        // 5. Kirim data ke View (Menggunakan nama variabel yang dikirim: pengumumans)
        return view('pengumuman', ['pengumumans' => $pengumumans]);
    }
}
