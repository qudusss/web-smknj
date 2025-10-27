@extends('master')

@section('title', 'Dokumen Download SMK Nurul Jadid')

@php
    // Wajib: Mengimpor helper Carbon dan pathinfo untuk mendapatkan ekstensi file
    use Carbon\Carbon;
@endphp

@section('content')
    <div class="container-xxl py-5">
        <div class="container-fluid">
            {{-- Header Halaman --}}
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Arsip</h6>
                <h1 class="mb-5">Download Dokumen</h1>
            </div>

            <div class="row wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-lg-12">
                    <div class="table-responsive shadow-sm rounded">
                        <table class="table table-striped table-hover align-middle mb-0">
                            <thead>
                                <tr class="table-primary">
                                    <th style="width: 5%;" class="py-3 px-4">No</th>
                                    <th class="py-3">Nama Dokumen</th>
                                    <th style="width: 15%;" class="py-3">Tipe File</th>
                                    <th style="width: 15%;" class="py-3">Tanggal Upload</th>
                                    <th style="width: 10%;" class="py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($downloads as $index => $item)
                                    <tr>
                                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                                        <td class="py-3">
                                            <i class="fa fa-file-alt text-primary me-2"></i>
                                            <strong>{{ $item->title }}</strong>
                                            <p class="text-muted small mb-0">{{ $item->description }}</p>
                                        </td>

                                        {{-- Kolom Tipe File (Dibuat Dinamis) --}}
                                        <td class="py-3">
                                            @php
                                                // Mendapatkan ekstensi file dari path
                                                $extension = pathinfo($item->file_path, PATHINFO_EXTENSION);
                                                // Menentukan warna badge
                                                $badgeClass = match (strtolower($extension)) {
                                                    'pdf' => 'bg-danger',
                                                    'docx', 'doc' => 'bg-primary',
                                                    'zip', 'rar' => 'bg-secondary',
                                                    default => 'bg-info',
                                                };
                                            @endphp
                                            <span class="badge {{ $badgeClass }}">{{ strtoupper($extension) }}</span>
                                        </td>

                                        {{-- Kolom Tanggal Upload --}}
                                        <td class="py-3">{{ Carbon::parse($item->created_at)->isoFormat('D MMMM Y') }}
                                        </td>

                                        {{-- Kolom Aksi --}}
                                        <td class="py-3 text-center">
                                            @if ($item->file_path)
                                                <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank"
                                                    class="btn btn-primary btn-sm" download>
                                                    <i class="fa fa-download me-2"></i>Download
                                                </a>
                                            @else
                                                <span class="text-muted small">File Hilang</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                @if ($downloads->isEmpty())
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-danger">Tidak ada dokumen yang
                                            tersedia saat ini.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Tambahkan Pagination di sini jika menggunakan paginate() di Controller --}}
        </div>
    </div>
@endsection
