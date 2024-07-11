@extends('page.layout.app')
@section('title', 'Dashboard')
@section('content')
    <section class="section main-banner" id="top" data-section="section1">
        <img src="{{ asset('dashboard/assets/images/bg_poliwangi1.jpg') }}" alt="Banner Image" id="bg-photo">
        <div class="video-overlay header-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="caption">
                            <h2>Unit Kerjasama</h2>
                            <h2>Politeknik Negeri Banyuwangi</h2>
                            <p>Selamat datang di halaman Unit Kerjasama Politeknik Negeri Banyuwangi. Kami berkomitmen untuk
                                menjalin kerjasama yang bermanfaat dengan berbagai pihak. Dapatkan informasi lebih lanjut
                                tentang kegiatan dan peluang kerjasama kami.</p>
                            <div class="main-button-red">
                                <div class="scroll-to-section"><a href="{{ url('/page-aktivitas') }}">Lihat Aktivitas</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="side-home" id="meetings">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
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
                <div class="col-lg-8">
                    <div class="mb-3">
                        <h2 class="text-center">Aktivitas Terkini</h2>
                        <hr>
                    </div>
                    <div class="row">
                        @foreach ($aktivitas as $a)
                            <div class="col-lg-4">
                                <div class="home-item">
                                    <div class="thumb">
                                        <a href="{{ url('/page-aktivitas/detail/' . $a->id) }}"><img
                                                src="{{ asset('data_aktivitas/' . $a->foto) }}"></a>
                                    </div>
                                    <div class="down-content">
                                        <a href="{{ url('/page-aktivitas/detail/' . $a->id) }}">
                                            <h4>{{ Str::limit($a->kegiatan, 40, '...') }}</h4>
                                        </a>
                                        <p>{{ textLimit($a->deskripsi, 80, '...') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="home-chart-page">
        <div class="container">
            <div class="mb-4">
                <h2 class="text-center">Grafik Kerjasama Terkini</h2>
                <hr>
            </div>
            <div class="row mb-4">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="tahunDari">Dari Tahun : </label>
                                        <select name="tahunDari" class="form-control select-tahun" id="tahunDari">
                                            <option value="2010">Semua Tahun</option>
                                            @foreach (array_combine(range(date('Y'), 2010), range(date('Y'), 2010)) as $year)
                                                <option value=" {{ $year }}"> {{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="tahunKe">Ke Tahun : </label>
                                        <select name="tahunKe" class="form-control select-tahun" id="tahunKe">
                                            <option value="all">Semua Tahun</option>
                                            @foreach (array_combine(range(date('Y'), 2010), range(date('Y'), 2010)) as $year)
                                                <option value=" {{ $year }}"> {{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <canvas id="chart-utama"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <div class="row d-flex justify-content-center">
                                    <div class="col-4 mr-4">
                                        <label for="tahunDariProdi">Dari Tahun : </label>
                                        <select name="tahunDariProdi" class="form-control select-tahun-prodi"
                                            id="tahunDariProdi">
                                            <option value="2010">Semua Tahun</option>
                                            @foreach (array_combine(range(date('Y'), 2010), range(date('Y'), 2010)) as $year)
                                                <option value=" {{ $year }}"> {{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="tahunKeProdi">Ke Tahun : </label>
                                        <select name="tahunKeProdi" class="form-control select-tahun-prodi"
                                            id="tahunKeProdi">
                                            <option value="all">Semua Tahun</option>
                                            @foreach (array_combine(range(date('Y'), 2010), range(date('Y'), 2010)) as $year)
                                                <option value=" {{ $year }}"> {{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <canvas id="chart-prodi"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <div class="row d-flex justify-content-center">
                                    <div class="col-4">
                                        <label for="tahunDariKategori">Dari Tahun : </label>
                                        <select name="tahunDariKategori" class="form-control select-tahun-kategori"
                                            id="tahunDariKategori">
                                            <option value="2010">Semua Tahun</option>
                                            @foreach (array_combine(range(date('Y'), 2010), range(date('Y'), 2010)) as $year)
                                                <option value=" {{ $year }}"> {{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="tahunKeKategori">Ke Tahun : </label>
                                        <select name="tahunKeKategori" class="form-control select-tahun-kategori"
                                            id="tahunKeKategori">
                                            <option value="all">Semua Tahun</option>
                                            @foreach (array_combine(range(date('Y'), 2010), range(date('Y'), 2010)) as $year)
                                                <option value=" {{ $year }}"> {{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <canvas id="chart-kategori"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
