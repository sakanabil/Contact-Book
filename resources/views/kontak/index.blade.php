@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-sm btn-success mt-1"
                        onclick="modalAction('{{ url('kontak/create_ajax') }}')">
                    Tambah Ajax
                </button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

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
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog"
         data-backdrop="static" data-keyboard="false" aria-hidden="true"></div>
@endsection

@push('js')
<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function () {
            $('#myModal').modal('show');
        });
    }

    $(document).ready(function () {
        $('#table_kontak').DataTable({
            serverSide: true,
            ajax: {
                url: "{{ url('kontak/list') }}",
                type: "POST",
                dataType: "json",
                data: {_token: '{{ csrf_token() }}'}
            },
            columns: [
                { data: "DT_RowIndex", className: "text-center", orderable: false, searchable: false },
                { data: "nama", className: "", orderable: true, searchable: true },
                { data: "nomor_hp", className: "", orderable: true, searchable: true },
                { data: "email", className: "", orderable: true, searchable: true },
                { data: "alamat", className: "", orderable: true, searchable: true },
                { data: "aksi", className: "", orderable: false, searchable: false },
            ]
        });
    });
</script>
@endpush
