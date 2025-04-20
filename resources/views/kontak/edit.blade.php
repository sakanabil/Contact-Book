@empty($kontak)
    <!-- Jika data kontak kosong, tampilkan pesan kesalahan -->
    <div id="modal-master" class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Header modal -->
            <div class="modal-header">
                <h5 class="modal-title">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <!-- Body modal -->
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
    <!-- Jika data kontak ditemukan, tampilkan form edit -->
    <form action="{{ url('/kontak/' . $kontak->id) }}" method="POST" id="form-edit">
        @csrf <!-- Token keamanan untuk Laravel -->
        @method('PUT') <!-- Metode PUT untuk update data -->
        <div id="modal-master" class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Header modal -->
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Kontak</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <!-- Body modal dengan form input -->
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input value="{{ $kontak->nama }}" type="text" name="nama" id="nama" class="form-control" required>
                        <small id="error-nama" class="error-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Nomor HP</label>
                        <input value="{{ $kontak->nomor_hp }}" type="text" name="nomor_hp" id="nomor_hp" class="form-control" required>
                        <small id="error-nomor_hp" class="error-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input value="{{ $kontak->email }}" type="email" name="email" id="email" class="form-control">
                        <small id="error-email" class="error-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control">{{ $kontak->alamat }}</textarea>
                        <small id="error-alamat" class="error-text text-danger"></small>
                    </div>
                </div>
                <!-- Footer modal dengan tombol -->
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>

    <!-- Script validasi dan submit via AJAX -->
    <script>
        $(document).ready(function () {
            // Inisialisasi validasi form menggunakan jQuery Validation
            $("#form-edit").validate({
                rules: {
                    nama: { required: true, maxlength: 100 },
                    nomor_hp: { required: true, maxlength: 15 },
                    email: { email: true },
                    alamat: { maxlength: 255 }
                },
                submitHandler: function (form) {
                    // Submit form via AJAX jika validasi berhasil
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(), // Serialisasi data form
                        success: function (response) {
                            console.log(response);
                            if (response.status) {
                                // Jika sukses, tutup modal dan reload tabel
                                $('#myModal').modal('hide');
                                Swal.fire({ icon: 'success', title: 'Berhasil', text: response.message });
                                $('#table_kontak').DataTable().ajax.reload();
                            } else {
                                // Tampilkan error dari validasi backend
                                $('.error-text').text('');
                                $.each(response.msgField, function (prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
                                });
                                Swal.fire({ icon: 'error', title: 'Terjadi Kesalahan', text: response.message });
                            }
                        }
                    });
                    return false; // Cegah form submit biasa
                },
                errorElement: 'span', // Elemen error
                errorPlacement: function (error, element) {
                    // Tempatkan error di bawah input
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element) {
                    // Tambahkan class jika input error
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element) {
                    // Hapus class jika input tidak error
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endempty
