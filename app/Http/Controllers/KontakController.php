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
                $btn  = '<button onclick="modalAction(\'' . url('/kontak/' . $kontak->id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kontak/' . $kontak->id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kontak/' . $kontak->id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
