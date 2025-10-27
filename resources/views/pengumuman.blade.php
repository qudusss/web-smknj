@extends('master')

@section('title', 'Daftar Pengumuman SMK Nurul Jadid')

@php
    // Wajib: Mengimpor helper Str dan Carbon
    use Illuminate\Support\Str;
    use Carbon\Carbon;
@endphp

@section('content')
    <style>
        /* CSS Read More (Sama seperti sebelumnya) */
        .read-more-link {
            /* ... */
        }

        .read-more-link:hover {
            /* ... */
        }

        .excerpt-container ol,
        .excerpt-container ul {
            /* ... */
        }
    </style>

    <div class="container-xxl py-5">
        <div class="container">
            {{-- HEADER HALAMAN --}}
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Informasi</h6>
                <h1 class="mb-5">Daftar Pengumuman</h1>
            </div>

            {{-- FORM PENCARIAN --}}
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8">
                    <form action="{{ route('pengumuman.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control form-control-lg"
                                placeholder="Cari pengumuman..." value="{{ request('search') }}">
                            <button class="btn btn-primary px-4" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- DAFTAR PENGUMUMAN (Card-View) --}}
            <div class="row g-4 justify-content-center">
                @forelse ($pengumumans as $item)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="card h-100 shadow-sm border-0 d-flex flex-column">
                            <div class="card-body p-4 d-flex flex-column">

                                {{-- TANGGAL TERBIT (Menggunakan Accessor) --}}
                                <small class="text-primary">
                                    <i class="fa fa-calendar-alt me-2"></i>
                                    {{ $item->formatted_published_at }}
                                </small>

                                <h5 class="card-title mt-2 mb-3">{{ $item->title }}</h5>

                                {{-- LOGIKA READ MORE TERINTEGRASI --}}
                                @php
                                    $fullContent = $item->content;
                                    $limit = 200;
                                    $strippedExcerpt = strip_tags($fullContent);
                                    $isLong = strlen($strippedExcerpt) > $limit;
                                    $excerptContainerId = 'excerpt-' . $item->id;
                                @endphp

                                <div id="{{ $excerptContainerId }}" class="card-text text-muted mb-3 excerpt-container">
                                    @if ($isLong)
                                        <span class="truncated-text">
                                            {{ $item->excerpt }} {{-- Menggunakan Accessor --}}
                                        </span>
                                        <span class="full-text" style="display: none;">
                                            {!! $fullContent !!}
                                        </span>
                                        <a href="#" class="read-more-link ms-1"
                                            data-target-id="{{ $excerptContainerId }}"> Read More
                                        </a>
                                    @else
                                        {!! $fullContent !!}
                                    @endif
                                </div>

                                {{-- LOGIKA TOMBOL DETAIL KONDISIONAL URL/MODAL --}}
                                @php
                                    $targetUrl = $item->link_url ?? '#';
                                    $modalAttrs = $item->link_url
                                        ? 'target="_blank"'
                                        : 'data-bs-toggle="modal" data-bs-target="#pengumumanModal' . $item->id . '"';
                                @endphp

                                <a href="{{ $targetUrl }}" class="btn btn-outline-primary btn-sm mt-auto"
                                    {{ $modalAttrs }}>
                                    {{ $item->link_url ? 'Cek Status' : 'Lihat Detail' }} <i class="fa fa-eye ms-2"></i>
                                </a>

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted fs-5">Pengumuman tidak ditemukan.</p>
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION LINKS --}}
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    {{ $pengumumans->links() }}
                </div>
            </div>

        </div>
    </div>

    {{-- MODAL (Pop-up) --}}
    @foreach ($pengumumans as $item)
        @if (!$item->link_url)
            <div class="modal fade" id="pengumumanModal{{ $item->id }}" tabindex="-1"
                aria-labelledby="pengumumanModalLabel{{ $item->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="pengumumanModalLabel{{ $item->id }}">{{ $item->title }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-muted small">
                                Diterbitkan pada:
                                {{ Carbon::parse($item->published_at)->isoFormat('dddd, D MMMM YYYY [pukul] HH:mm') }}
                            </p>
                            <hr>
                            <div class="isi-pengumuman">
                                {!! $item->content !!}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- KODE UNTUK READ MORE (JS) ---
            document.querySelectorAll('.read-more-link').forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const targetId = this.getAttribute('data-target-id');
                    const container = document.getElementById(targetId);
                    if (container) {
                        const truncatedText = container.querySelector('.truncated-text');
                        const fullText = container.querySelector('.full-text');
                        if (truncatedText && fullText) {
                            truncatedText.style.display = 'none';
                            fullText.style.display = 'block';
                            this.style.display = 'none';
                        }
                    }
                });
            });
        });
    </script>
@endsection
