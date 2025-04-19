@empty($kontak)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('/kontak') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Kontak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <table class="table table-sm table-bordered table-striped">
                    <tr>
                        <th class="text-right col-3">ID :</th>
                        <td class="col-9">{{ $kontak->id }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Nama :</th>
                        <td class="col-9">{{ $kontak->nama }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Nomor HP :</th>
                        <td class="col-9">{{ $kontak->nomor_hp }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Email :</th>
                        <td class="col-9">{{ $kontak->email }}</td>
                    </tr>
                    <tr>
                        <th class="text-right col-3">Alamat :</th>
                        <td class="col-9">{{ $kontak->alamat }}</td>
                    </tr>
                </table>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary">Tutup</button>
            </div>
        </div>
    </div>
@endempty