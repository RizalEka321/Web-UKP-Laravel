@extends('page.layout.app')
@section('title', 'Visi & Misi')
@section('content')
    <section class="heading-page header-text" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Visi dan Misi</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="page-ku" id="meetings">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="isi-single-item">
                        <div class="down-content">
                            <div id="visimisi">
                                {!! $visimisi->visimisi !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="categories">
                        <h4>Aktivitas Lainnya</h4>
                        <ul>
                            @foreach ($aktivitas_lain as $l)
                                <li><a
                                        href="{{ url('/page-aktivitas/detail/' . $l->id) }}">{{ Str::limit($l->kegiatan, 40, '...') }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="main-button-red">
                            <a href="{{ url('/page-aktivitas') }}">Lihat Aktivitas Lainnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
