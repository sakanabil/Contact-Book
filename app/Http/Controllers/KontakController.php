<?php

namespace App\Http\Controllers;

use App\Models\KontakModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KontakController extends Controller
{
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

    public function list(Request $request)
    {
        $kontak = KontakModel::select('id', 'nama', 'nomor_hp', 'email', 'alamat');

        return DataTables::of($kontak)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kontak) {
                $btn  = '<button onclick="modalAction(\'' . url('/kontak/' . $kontak->id . '/show') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kontak/' . $kontak->id . '/edit') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kontak/' . $kontak->id . '/delete') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        return view('kontak.create'); // file view modal tambah
    }

    public function store(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama' => 'required|string|max:100',
                'nomor_hp' => 'required|string|max:15',
                'email' => 'required|email|unique:kontak,email',
                'alamat' => 'required|string|max:255'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            KontakModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data kontak berhasil disimpan'
            ]);
        }
    }

    public function show(string $id)
    {
        $kontak = KontakModel::find($id);
        return view('kontak.show', ['kontak' => $kontak]);
    }

    public function edit(string $id)
    {
        $kontak = KontakModel::find($id);
        return view('kontak.edit', ['kontak' => $kontak]);
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama' => 'required|string|max:100',
                'nomor_hp' => 'required|string|max:15',
                'email' => 'nullable|email',
                'alamat' => 'nullable|string|max:255',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $kontak = KontakModel::find($id);
            if ($kontak) {
                $kontak->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate.'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan.'
                ]);
            }
        }
        return redirect('/');
    }

    public function confirm(string $id)
    {
        $kontak = KontakModel::find($id);
        return view('kontak.confirm', ['kontak' => $kontak]);
    }

    public function delete(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $kontak = KontakModel::find($id);
            if ($kontak) {
                $kontak->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data kontak berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data kontak tidak ditemukan'
                ]);
            }
        }
        
        return redirect('/');
    }

}
