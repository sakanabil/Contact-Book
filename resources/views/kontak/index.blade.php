@extends('layouts.template') <!-- Menggunakan template layout utama -->

@section('content')
    <!-- Card untuk menampilkan daftar kontak -->
    <div class="card card-outline card-primary">
        <div class="card-header">
            <!-- Judul halaman -->
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <!-- Tombol untuk membuka modal tambah kontak -->
                <button type="button" class="btn btn-sm btn-success mt-1"
                        onclick="modalAction('{{ url('kontak/create') }}')">
                    Tambah
                </button>
            </div>
        </div>
        <div class="card-body">
            <!-- Tampilkan pesan sukses jika ada -->
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Tampilkan pesan error jika ada -->
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!-- Tabel untuk menampilkan data kontak -->
            <table class="table table-bordered table-striped table-hover table-sm" id="table_kontak">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nomor HP</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Modal yang akan diisi dengan konten dinamis -->
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog"
         data-backdrop="static" data-keyboard="false" aria-hidden="true"></div>
@endsection

@push('js')
<script>
    // Fungsi untuk memuat modal dari URL tertentu
    function modalAction(url = '') {
        $('#myModal').load(url, function () {
            $('#myModal').modal('show');
        });
    }

    // Inisialisasi DataTable saat dokumen siap
    $(document).ready(function () {
        $('#table_kontak').DataTable({
            serverSide: true, // Gunakan server-side processing
            ajax: {
                url: "{{ url('kontak/list') }}", // URL untuk mengambil data
                type: "POST",
                dataType: "json",
                data: {_token: '{{ csrf_token() }}'} // Kirim token CSRF
            },
            columns: [
                // Kolom untuk penomoran
                { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                // Kolom nama
                { data: "nama", className: "", orderable: true, searchable: true },
                // Kolom nomor HP
                { data: "nomor_hp", className: "", orderable: true, searchable: true },
                // Kolom email
                { data: "email", className: "", orderable: true, searchable: true },
                // Kolom alamat
                { data: "alamat", className: "", orderable: true, searchable: true },
                // Kolom aksi (edit, delete, dll)
                { data: "aksi", className: "", orderable: false, searchable: false },
            ]
        });
    });
</script>
@endpush
