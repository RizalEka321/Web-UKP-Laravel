@extends('page.layout.app')
@section('title', 'Detail Aktivitas')
@section('content')
    <section class="heading-page header-text" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Detail Kegiatan</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="isi-page" id="isi">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="isi-single-item">
                        <div class="down-content">
                            <a href="isi-details.html">
                                <h4>{{ $aktivitas->kegiatan }}</h4>
                            </a>
                            <p>Tanggal :
                                {{ \Carbon\Carbon::parse($aktivitas->tanggal)->translatedFormat('l, j F Y') }}</p>
                            <hr>
                            {!! $aktivitas->deskripsi !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="services">
        <div class="container">
            <h2 class="text-end">Berita Lainnya</h2>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-service-item owl-carousel">
                        @foreach ($aktivitas_lain as $a)
                            <div class="item">
                                <div class="icon">
                                    <img src="{{ asset('data_aktivitas/' . $a->foto) }}" alt="">
                                </div>
                                <div class="item-content">
                                    <h4>{{ Str::limit($a->kegiatan, 40, '...') }}</h4>
                                    <p>{{ textLimit($a->deskripsi, 80, '...') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
