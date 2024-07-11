@extends('admin.layouts.app')
@push('css')
    <style>
        .tio-button {
            border: none !important;
            background: none !important;
            color: #004878;
            cursor: pointer;
        }

        .action {
            display: flex;
            justify-content: space-between;
        }
    </style>
@endpush
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                            <h4>Data Kerjasama</h4>
                            <a href="{{ url('/kerjasama/create') }}" class="btn btn-primary">Tambah Kerjasama</a>
                        </div>
                        <div class="card-body">
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form class="form mb-3" method="get" action="{{ url('/kerjasama/cari') }}">
                                <div class="row">
                                    <div class="col-3 ">
                                        <label>Cari Data </label>
                                        <input type="text" name="cari" class="form-control" id="search"
                                            placeholder="Masukkan Nomor Mou / Nama Instansi">
                                    </div>
                                    <div class="col-3 ">
                                        <label>Filter Data </label>
                                        <select name="expired" class="form-control" id="">
                                            <option value="all" selected>--- Semua ---</option>
                                            <option value="akan_berakhir"
                                                {{ request('expired') == 'akan_berakhir' ? 'selected' : '' }}>Belum Berakhir
                                            </option>
                                            <option value="berakhir"
                                                {{ request('expired') == 'berakhir' ? 'selected' : '' }}>Telah Berakhir
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-3 ">
                                        <label>Filter Prodi </label>
                                        <select name="prodi" class="form-control" id="">
                                            <option value="" selected>--- Semua Prodi ---</option>
                                            @foreach ($prodis as $p)
                                                <option value="{{ $p->id_prodi }}"
                                                    {{ request('prodi') == $p->id_prodi ? 'selected' : '' }}>
                                                    {{ $p->nama_prodi }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3 ">
                                        <label>Urutkan Data </label>
                                        <select name="sort" class="form-control" id="">
                                            <option value="default" selected>--- Default ---</option>
                                            {{-- <option value="nama">Nama </option> --}}
                                            <option value="tanggal_mulai">Tanggal Mulai</option>
                                            <option value="tanggal_berakhir">Tanggal Berakhir</option>
                                        </select>
                                    </div>
                                    <div class="col-1">
                                        <label></label>
                                        <button type="submit" class="btn btn-primary mt-1">Search</button>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nomor Mou</th>
                                            <th scope="col">Nama Instansi</th>
                                            <th scope="col">Contact Person</th>
                                            <th scope="col">Kategori</th>
                                            <th scope="col">Tanggal Mulai</th>
                                            <th scope="col">Tanggal Berakhir</th>
                                            <th scope="col">Hard File</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Soft File</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kerjasama as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a
                                                        href="{{ url('/kerjasama/download/' . $item->file_mou) }}">{{ $item->nomor_mou }}</a>
                                                </td>
                                                <td>{{ $item->nama_instansi }}</td>
                                                <td>{{ $item->contact_person }}</td>
                                                <td>{{ $item->kategori->nama_kategori }}</td>
                                                <td>{{ $item->tgl_mulai }}</td>
                                                <td>{{ $item->tgl_berakhir }}</td>
                                                <td>
                                                    {{ $item->hard_file == 0 ? 'Tidak Tersedia' : 'Tersedia' }}
                                                </td>
                                                <td
                                                    style="background-color: {{ $item->status == 0 ? 'lightblue' : 'lightgreen' }}; border-radius: 10px; padding: 2px 6px; text-align: center;">
                                                    {{ $item->status == 0 ? 'Pending' : 'Diterima' }}
                                                </td>
                                                <td class="">
                                                    <a href="{{ url('/kerjasama/download/' . $item->file_mou) }}">
                                                        <i class="icon-ganteng fa-solid fa-file-arrow-down"></i>
                                                    </a>
                                                </td>
                                                <td class=" ">
                                                    {{ $item->id }}
                                                    <div class="action">
                                                        @if (Auth::user()->role == 'admin')
                                                            <a href="{{ url('/kerjasama/edit/' . $item->id_kerjasama) }}"><i
                                                                    class="icon-ganteng fa-solid fa-pen-to-square"></i></a>
                                                        @endif
                                                        <a href="{{ url('/kerjasama/show/' . $item->id_kerjasama) }}"><i
                                                                class=" ml-1 icon-ganteng fa-solid fa-eye"></i></a>
                                                        <form method="post"
                                                            action="{{ url('/kerjasama/delete/' . $item->id_kerjasama) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                style="background: none; border:none;cursor:pointer">
                                                                <i class="ml-1 icon-ganteng fa-solid fa-trash"
                                                                    style="color: #004878;""></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="pagination pl-2 ml-4">
                                    {{ $kerjasama->links('pagination::bootstrap-4') }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
