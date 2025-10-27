@extends('master')

@section('title', 'Daftar Berita')

@php
    // Wajib: Mengimpor helper Str untuk Str::limit
    use Illuminate\Support\Str;
@endphp

@section('content')
    <style>
        /* CSS Wajib untuk Menyeragamkan Tampilan Gambar */
        .img-container {
            /* Rasio 4:3 (Tinggi 75% dari Lebar) */
            position: relative;
            width: 100%;
            padding-top: 75%;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .img-container img {
            /* Gambar mengisi container rasio aspek */
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Penting: Memastikan gambar menutupi container tanpa meregang */
            transition: transform 0.3s ease;
        }

        .course-item:hover .img-container img {
            transform: scale(1.05);
            /* Efek zoom saat hover */
        }
    </style>

    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h3 class="section-title bg-white text-center text-primary px-3 mb-5">Daftar Berita</h3>
            </div>
            <div class="row g-4 justify-content-center">

                @foreach ($berita as $b)
                    {{-- Ganti col-lg-4 col-md-7 menjadi col-lg-4 col-md-6 agar lebih rapi --}}
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        {{-- Wajib: h-100 dan d-flex flex-column untuk tinggi kartu yang seragam --}}
                        <div class="course-item bg-light h-100 d-flex flex-column">

                            {{-- Container Gambar dengan Rasio Aspek --}}
                            <div class="position-relative overflow-hidden img-container">
                                <img src="{{ asset('storage/' . $b->foto) }}" alt="Foto Berita {{ $b->judul }}">
                            </div>

                            <div class="text-end p-4 pb-0 flex-grow-1 d-flex flex-column">
                                <div class="mb-3">
                                    {{-- Kolom Bintang / Akses (Tetap dipertahankan) --}}
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small>({{ $b->akses }}x diakses)</small>
                                </div>
                                <h5 class="mb-4">{{ $b->judul }}</h5>

                                {{-- Excerpt didorong ke bawah oleh flex-grow-1 --}}
                                <p class="card-text flex-grow-1">{!! Str::limit($b->kalimat, 100) !!}</p>
                            </div>

                            {{-- Footer (Border Top) didorong ke bawah oleh mt-auto --}}
                            <div class="d-flex border-top mt-auto">
                                <small class="flex-fill text-center border-end py-2">
                                    {{-- Gunakan Carbon::parse jika created_at berupa string --}}
                                    <i
                                        class="fa fa-calendar text-primary me-2"></i>{{ \Carbon\Carbon::parse($b->created_at)->format('d M Y') }}
                                </small>
                                <small class="flex-fill text-center border-end py-2">
                                    <i class="fas fa-tag text-primary me-2"></i>{{ $b->kategori }}
                                </small>
                                <small class="flex-fill text-center py-2">
                                    <a href="{{ route('detail-berita', $b->id) }}" class="text-danger"><b>Read More</b></a>
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- Pagination --}}
                <div class="col-12 mt-5 d-flex justify-content-center">
                    {{ $berita->links('pagination::bootstrap-4') }}
                </div>

            </div>
        </div>
    </div>
@endsection
