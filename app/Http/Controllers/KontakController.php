<?php

namespace App\Http\Controllers;

use App\Models\KontakModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KontakController extends Controller
{
    // Menampilkan halaman utama daftar kontak
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kontak',
            'list' => ['Home', 'Kontak']
        ];

        $page = (object) [
            'title' => 'Data Kontak'
        ];

        $activeMenu = 'kontak';

        return view('kontak.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    // Mengambil data untuk DataTables (AJAX)
    public function list(Request $request)
    {
        $kontak = KontakModel::select('id', 'nama', 'nomor_hp', 'email', 'alamat');

        return DataTables::of($kontak)
            ->addIndexColumn() // Tambahkan kolom nomor urut
            ->addColumn('aksi', function ($kontak) {
                // Tombol aksi: Detail, Edit, Hapus
                $btn  = '<button onclick="modalAction(\'' . url('/kontak/' . $kontak->id . '/show') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kontak/' . $kontak->id . '/edit') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kontak/' . $kontak->id . '/delete') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // Render HTML tombol
            ->make(true);
    }

    // Menampilkan form tambah kontak (modal)
    public function create()
    {
        return view('kontak.create'); // file view modal tambah
    }

    // Menyimpan data kontak baru
    public function store(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            // Validasi input
            $rules = [
                'nama' => 'required|string|max:100',
                'nomor_hp' => 'required|string|max:15',
                'email' => 'required|email|unique:kontak,email',
                'alamat' => 'required|string|max:255'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                // Jika validasi gagal
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            // Simpan data ke database
            KontakModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data kontak berhasil disimpan'
            ]);
        }
    }

    // Menampilkan detail data kontak
    public function show(string $id)
    {
        $kontak = KontakModel::find($id);
        return view('kontak.show', ['kontak' => $kontak]);
    }

    // Menampilkan form edit kontak (modal)
    public function edit(string $id)
    {
        $kontak = KontakModel::find($id);
        return view('kontak.edit', ['kontak' => $kontak]);
    }

    // Memperbarui data kontak
    public function update(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            // Validasi input untuk update
            $rules = [
                'nama' => 'required|string|max:100',
                'nomor_hp' => 'required|string|max:15',
                'email' => 'nullable|email',
                'alamat' => 'nullable|string|max:255',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                // Jika validasi gagal
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            // Cek apakah data kontak ditemukan
            $kontak = KontakModel::find($id);
            if ($kontak) {
                // Update data kontak
                $kontak->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate.'
                ]);
            } else {
                // Data tidak ditemukan
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan.'
                ]);
            }
        }
        return redirect('/');
    }

    // Menampilkan konfirmasi penghapusan (modal)
    public function confirm(string $id)
    {
        $kontak = KontakModel::find($id);
        return view('kontak.confirm', ['kontak' => $kontak]);
    }

    // Menghapus data kontak
    public function delete(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $kontak = KontakModel::find($id);
            if ($kontak) {
                // Hapus data
                $kontak->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data kontak berhasil dihapus'
                ]);
            } else {
                // Data tidak ditemukan
                return response()->json([
                    'status' => false,
                    'message' => 'Data kontak tidak ditemukan'
                ]);
            }
        }

        return redirect('/');
    }
}
