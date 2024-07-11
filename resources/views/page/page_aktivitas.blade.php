@extends('page.layout.app')
@section('title', 'Aktivitas')
@section('content')
    <section class="heading-page header-text" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Kegiatan Kerjasama</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="isi-page" id="isi">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="filters">
                        <ul>
                            <li data-filter="*" class="active">Semua Kategori</li>
                            @foreach ($kategori as $k)
                                <li data-filter=".{{ $k->id_kategori }}">{{ $k->nama_kategori }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row grid">
                        @foreach ($aktivitas as $k)
                            <div class="col-lg-4 templatemo-item-col all {{ $k->id_kategori }}">
                                <div class="isi-item">
                                    <div class="thumb">
                                        <div class="price">
                                            <span>{{ $k->kategori->nama_kategori }}</span>
                                        </div>
                                        <img src="{{ asset('data_aktivitas/' . $k->foto) }}" alt="">
                                    </div>
                                    <div class="down-content">
                                        <a href="{{ url('/page-aktivitas/detail/' . $k->id) }}">
                                            <h4>{{ Str::limit($k->kegiatan, 40, '...') }}</h4>
                                        </a>
                                        <p>{{ textLimit($k->deskripsi, 80, '...') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Pagination links -->
            {{-- <div class="d-flex justify-content-center">
                {{ $kerjasama->links() }}
            </div> --}}
        </div>
    </section>
@endsection
