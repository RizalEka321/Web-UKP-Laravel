@extends('page.layout.app')
@section('title', 'Kerjasama')
@section('content')
    <section class="heading-page header-text" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Daftar Instansi yang Telah Bekerjasama</h2>
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
                            <p class="description text-center">
                                Selamat datang di halaman daftar instansi yang telah bekerjasama dengan Politeknik Negeri
                                Banyuwangi. Di sini, Anda dapat menemukan berbagai informasi mengenai kerjasama yang telah
                                terjalin antara institusi kami dengan berbagai partner industri dan pendidikan lainnya.
                            </p>
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" width="5%">No</th>
                                                    <th width="70%">Instansi</th>
                                                    <th width="25%">Kategori</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kerjasama as $item)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td>{{ $item->nama_instansi }}</td>
                                                        <td>{{ $item->kategori->nama_kategori }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="pagination text-center">
                                            {{ $kerjasama->links('pagination::bootstrap-4') }}
                                        </div>
                                        <style>
                                            .pagination li.page-item .active {
                                                background-color: #010e70;
                                            }
                                        </style>
                                    </div>
                                </div>
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
