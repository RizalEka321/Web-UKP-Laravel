@extends('admin.layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Struktur Organisasi</h4>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form action="{{ url('/struktur/update/' . $struktur->id) }}" method="POST"
                                enctype="multipart/form-data" id="form-tambah">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12 mb-2">
                                        <div class="form-group">
                                            <label for="ketua">Nama Ketua Unit</label>
                                            <input type="text"
                                                class="form-control @error('ketua')
                                                is-invalid
                                            @enderror"
                                                id="ketua" name="ketua" aria-describedby="mouHelp"
                                                placeholder="Masukkan Nama" value="{{ $struktur->ketua }}">
                                            @error('ketua')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-2">
                                        <div class="form-group">
                                            <label for="sekretaris">Nama Sekretaris Unit</label>
                                            <input type="text"
                                                class="form-control @error('sekretaris')
                                                is-invalid
                                            @enderror"
                                                id="sekretaris" name="sekretaris" aria-describedby="mouHelp"
                                                placeholder="Masukkan Nama" value="{{ $struktur->sekretaris }}">
                                            @error('sekretaris')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-2">
                                        <div class="form-group">
                                            <label for="staf">Nama Staf Unit</label>
                                            <input type="text"
                                                class="form-control @error('staf')
                                                is-invalid
                                            @enderror"
                                                id="staf" name="staf" aria-describedby="mouHelp"
                                                placeholder="Masukkan Nama" value="{{ $struktur->staf }}">
                                            @error('staf')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="button-tambah" class="btn btn-primary"
                                    style="float: right">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#prodi').select2({
                    tags: true,
                    placeholder: "Pilih Prodi",
                    // selectionCssClass: "form-control"

                });
                $('#kategori').select2({
                    tags: true,
                    placeholder: "Pilih Kategori"
                });
                $('#button-tambah').on("click", function(e) {
                    e.preventDefault();
                    var form = $(this).parents('form');
                    Swal.fire({
                        icon: 'warning',
                        title: 'Apakah Anda Yakin ?',
                        showDenyButton: true,
                        confirmButtonText: 'Yakin',
                        denyButtonText: `Tidak`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#form-tambah").submit();
                        } else if (result.isDenied) {
                            Swal.fire('Data Tidak Ditambahkan', '', 'success')
                        }
                    })
                })
            });
        </script>
    @endpush
@endsection
