@extends('admin.layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                            <h4>Data File MOU</h4>
                            @if (Auth::user()->role == 'admin')
                                <a href="{{ url('/file-mou/create') }}" class="btn btn-primary">Tambah File</a>
                            @endif
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
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th width="80%">Nama File</th>
                                            <th width="15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($file as $item)
                                            <tr>
                                                <th scope="row">{{ $file->firstItem() + $loop->index }}</th>
                                                <td>{{ $item->nama_file }}</td>
                                                <td>
                                                    @if (Auth::user()->role == 'admin')
                                                        <a href="{{ url('/file-mou/edit/' . $item->id) }}"><i
                                                                class="icon-ganteng fa-solid fa-pen-to-square"></i></a>
                                                        <a href="{{ url('/file-mou/download/' . $item->id) }}"><i
                                                                class="icon-ganteng fa-solid fa-eye"></i></a>
                                                        <a href="{{ url('/file-mou/delete/' . $item->id) }}"><i
                                                                class="icon-ganteng fa-solid fa-trash"></i></a>
                                                    @else
                                                        <a href="{{ url('/file-mou/download/' . $item->id) }}"><i
                                                                class="icon-ganteng fa-solid fa-download"></i></a>
                                                    @endif
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
                </div>
            </div>
        </section>
    </div>
@endsection
