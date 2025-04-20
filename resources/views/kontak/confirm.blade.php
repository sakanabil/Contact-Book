@empty($kontak)
    <!-- Jika data kontak tidak ditemukan -->
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>

            <!-- Body -->
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
    <!-- Form konfirmasi hapus -->
    <form action="{{ url('/kontak/' . $kontak->id . '/delete') }}" method="POST" id="form-delete">
        @csrf <!-- CSRF protection -->
        @method('DELETE') <!-- Method spoofing untuk request DELETE -->
        
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Kontak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <h5><i class="icon fas fa-ban"></i> Konfirmasi !!!</h5>
                        Apakah Anda ingin menghapus data seperti di bawah ini?
                    </div>
                    <!-- Tampilkan data yang akan dihapus -->
                    <table class="table table-sm table-bordered table-striped">
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

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </form>

    <!-- Validasi dan AJAX hapus -->
    <script>
        $(document).ready(function() {
            $("#form-delete").validate({
                rules: {}, // Tidak ada input, jadi tidak perlu rules
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status) {
                                // Jika berhasil, tutup modal dan reload DataTable
                                $('#myModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                });
                                $('#table_kontak').DataTable().ajax.reload();
                            } else {
                                // Jika gagal, tampilkan alert
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        }
                    });
                    return false; // Cegah submit default
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endempty
