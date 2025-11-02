{{-- resources/views/ekstrakurikuler.blade.php --}}

@extends('master')

@section('title', 'Ekstrakurikuler SMK Nurul Jadid')

@php
    use Illuminate\Support\Str;
    $EXCERPT_LIMIT = 100;
@endphp

@section('content')

    {{-- ... (CSS dan HEADER HALAMAN tetap di sini) ... --}}

    <div class="container-xxl py-5">
        <div class="container-fluid">
            {{-- ... (Header dan Loop @forelse) ... --}}
            <div class="row g-5">
                @forelse ($ekstrakurikulers as $v)
                    <div class="col-lg-4 col-md-6 wow zoomIn d-flex" data-wow-delay="0.3s">
                        <div class="card h-100 d-flex flex-column shadow-sm">

                            {{-- Gambar --}}
                            <div class="position-relative overflow-hidden" style="height: 250px;">
                                <img class="card-img-top" src="{{ asset('storage/' . $v->foto) }}" alt="{{ $v->nama }}"
                                    style="width: 100%; height: 100%; object-fit: cover;" />
                            </div>

                            <div class="card-body p-4 d-flex flex-column flex-grow-1">
                                <h4 class="card-title text-primary">{{ $v->nama }}</h4>

                                @php
                                    $fullContent = strip_tags($v->deskripsi);
                                    $isLong = strlen($fullContent) > $EXCERPT_LIMIT;
                                @endphp

                                <p id="ekskul-desc-{{ $v->id }}" class="card-text text-muted small mb-3 flex-grow-1">
                                    @if ($isLong)
                                        {{-- Teks Singkat --}}
                                        <span class="truncated-text" data-id="{{ $v->id }}">
                                            {{ Str::limit($fullContent, $EXCERPT_LIMIT, '') }}
                                        </span>
                                        {{-- Teks Penuh (Tersembunyi) --}}
                                        <span class="full-text" data-id="{{ $v->id }}" style="display: none;">
                                            {{ $fullContent }}
                                        </span>
                                        {{-- Tombol Read More --}}
                                        <a href="#" class="read-more-toggle text-primary fw-bold"
                                            data-id="{{ $v->id }}" data-state="short">...Read More</a>
                                    @else
                                        {{-- Tampilkan penuh jika pendek --}}
                                        {{ $fullContent }}
                                    @endif
                                </p>

                                {{-- Tombol Placeholder Dihapus --}}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted fs-5">Data ekstrakurikuler belum tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    {{-- =============================================== --}}
    {{-- == JAVASCRIPT UNTUK FUNGSI READ MORE/LESS == --}}
    {{-- =============================================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.read-more-toggle').forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();

                    const itemId = this.getAttribute('data-id');
                    const currentState = this.getAttribute('data-state');

                    const shortText = document.querySelector(
                        `.truncated-text[data-id="${itemId}"]`);
                    const fullText = document.querySelector(`.full-text[data-id="${itemId}"]`);

                    if (currentState === 'short') {
                        // Tampilkan teks penuh
                        shortText.style.display = 'none';
                        fullText.style.display = 'inline';
                        this.textContent = ' Hide';
                        this.setAttribute('data-state', 'full');
                    } else {
                        // Sembunyikan teks penuh
                        fullText.style.display = 'none';
                        shortText.style.display = 'inline';
                        this.textContent = '...Read More'; // Kembalikan teks tombol
                        this.setAttribute('data-state', 'short');
                    }
                });
            });
        });
    </script>
@endsection
