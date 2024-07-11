@extends('page.layout.app')
@section('title', 'Panduan')
@section('content')
    <section class="heading-page header-text" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Panduan Pengajuan</h2>
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
                            <div id="panduan">
                                {!! $panduan->panduan !!}
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
@push('css')
    <style>
        #panduan {
            box-shadow: 5px 5px 5px rgb(155, 155, 155);
            border: 1px solid rgb(155, 155, 155);
            border-radius: 20px;
            padding: 20px;
        }

        #panduan p {
            font-size: 16px;
        }

        #pamduan ul,
        li {
            padding: 0;
            margin-left: 17px;
        }
    </style>
@endpush
