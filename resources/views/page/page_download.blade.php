@extends('page.layout.app')
@section('title', 'MOU')
@section('content')
    <section class="heading-page header-text" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Dokumentasi MOU</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="download-page" id="download">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="isi-single-item">
                        <div class="down-content">
                            <p class="description text-center">
                                Selamat datang di halaman dokumentasi MOU kami. Di sini, Anda dapat menemukan berbagai
                                template MOU yang dapat diunduh untuk keperluan bisnis dan kerjasama Anda. Kami menyediakan
                                berbagai jenis dokumen untuk memudahkan proses pembuatan kesepakatan yang resmi dan sesuai
                                kebutuhan Anda.
                            </p>
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" width="5%">No</th>
                                                    <th width="80%">Nama File</th>
                                                    <th width="15%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($file as $item)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td>{{ $item->nama_file }}</td>
                                                        <td>
                                                            <div class="main-button-red">
                                                                <a href="{{ url('/file-mou/download' . $item->id) }}">Download
                                                                    Template</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="pagination pl-2 ml-4">
                                            {{ $file->links('pagination::bootstrap-4') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="download-message text-center mt-4">
                                <p>Unduh template MOU kami untuk memudahkan pembuatan dokumen kesepakatan yang resmi dan
                                    terpercaya. Klik tombol "Download Template" untuk memulai!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
