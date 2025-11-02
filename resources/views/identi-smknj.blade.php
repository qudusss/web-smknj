@extends('master')

@section('title', 'Identitas SMK Nurul Jadid')

@section('content')

    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">@yield('title')</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="{{ route('beranda') }}">Beranda</a>
                            </li>
                            <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">@yield('title')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h3 class="section-title bg-white text-center text-primary px-3">Identitas</h3>
                <h1 class="mb-5">SMK Nurul Jadid</h1>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col col-lg-12 col-md-6">
                    <div class="table-responsive">
                        @foreach ($identi as $b)
                            <table class="table table-primary">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama Sekolah</th>
                                        <th scope="col">{{ $b->nama }} (SMKNJ)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="">
                                        <td scope="row">Tahun Berdiri</td>
                                        <td>{{ $b->tahun_berdiri }}</td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">Tahun Beroperasi</td>
                                        <td>{{ $b->tahun_beroperasi }}</td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">NSM</td>
                                        <td>{{ $b->nsm }}</td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">NPSN</td>
                                        <td>{{ $b->npsn }}</td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">NPWP</td>
                                        <td>{{ $b->npwp }}</td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">Status Akreditasi</td>
                                        <td>{{ $b->status_akreditasi }}</td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">Yayasan Penyelenggara</td>
                                        <td>{{ $b->yayasan_penyelenggara }}</td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">Nomor Telepon</td>
                                        <td>{{ $b->nomer_telepon }}</td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">Email</td>
                                        <td>{{ $b->email }}</td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">Website</td>
                                        <td>{{ $b->website }}</td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">Alamat</td>
                                        <td>{{ $b->alamat }}</td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">Desa</td>
                                        <td>{{ $b->desa }}</td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">Kecamatan</td>
                                        <td>{{ $b->kecamatan }}</td>
                                    </tr>
                                    <tr class="">
                                        <td scope="row">Kota</td>
                                        <td>{{ $b->kota }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
