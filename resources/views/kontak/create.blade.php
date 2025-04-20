<form action="{{ url('/kontak/store') }}" method="POST" id="form-tambah">
    @csrf <!-- Token keamanan untuk mencegah CSRF -->

    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- Header modal -->
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Kontak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>

            <!-- Body modal dengan input form -->
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama</label>
                    <input value="" type="text" name="nama" id="nama" class="form-control" required>
                    <small id="error-nama" class="error-text form-text text-danger"></small>
                </div> 
                <div class="form-group">
                    <label>Nomor HP</label>
                    <input value="" type="text" name="nomor_hp" id="nomor_hp" class="form-control" required>
                    <small id="error-nomor_hp" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input value="" type="email" name="email" id="email" class="form-control">
                    <small id="error-email" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" rows="3"></textarea>
                    <small id="error-alamat" class="error-text form-text text-danger"></small>
                </div>
            </div>

            <!-- Footer modal dengan tombol aksi -->
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        // Inisialisasi validasi form
        $("#form-tambah").validate({
            rules: {
                nama: { required: true, maxlength: 100 },
                nomor_hp: { required: true, maxlength: 15 },
                email: { email: true },
                alamat: { maxlength: 255 }
            },
            submitHandler: function (form) {
                // Submit data dengan AJAX
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function (response) {
                        console.log(response); // Debug: tampilkan response di console

                        if (response.status) {
                            // Jika berhasil, tutup modal dan reload datatable
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            $('#table_kontak').DataTable().ajax.reload();
                        } else {
                            // Jika error, tampilkan pesan error per field
                            $('.error-text').text('');
                            $.each(response.msgField, function (prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
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
            errorPlacement: function (error, element) {
                // Tampilkan pesan error di bawah input
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element) {
                // Tambahkan class error
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                // Hapus class error
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
