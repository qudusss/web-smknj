@extends('master')

@section('title', 'Prestasi SMK Nurul Jadid')

@section('content')
    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container-fluid">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Galeri</h6>
                <h1 class="mb-5">Prestasi SMK Nurul Jadid</h1>
            </div>
            <div class="row g-5">
                @foreach ($prestasi as $v)
                    <div class="col-lg-4 col-md-12 wow zoomIn d-flex" data-wow-delay="0.3s">
                        <div class="card">
                            <img class="card-img-top" src="{{ asset('storage/' . $v->foto_prestasi) }}" alt="Title" />
                            <div class="card-body">
                                <h4 class="card-title">{{ $v->judul }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
