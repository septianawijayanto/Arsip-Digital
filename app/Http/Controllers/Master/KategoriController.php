<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Validator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Kategori';
        $datas = Kategori::all();
        if ($request->ajax()) {
            return datatables()->of($datas)->addIndexColumn()

                ->addColumn('action', function ($data) {
                    $button = '<a href="javascript:void(0)" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="Klik disini untuk mengedit data kategori dengan kode kategori : ' . $data->kode_kategori . '"  data-id="' . $data->id . '" data-original-title="Edit" class="btn btn-warning btn-xs edit-post"><i class="fas fa-pencil-alt"></i> </a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button"  name="delete" id="' . $data->id . '" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="Klik disini untuk menghapus data kategori dengan kode kategori : ' . $data->kode_kategori . '"   class="delete btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $button;
                })->make(true);
        }
        return view('kategori.index', compact('title'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = $request->id;
        if ($id == 0) {
            $validator = Validator::make($request->all(), [
                'kode_kategori' => 'required|unique:kategori|min:3|max:10',
                'nama_kategori' => 'required|max:60',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'kode_kategori' => 'required|unique:kategori,id',
                'nama_kategori' => 'required|max:60',
            ]);
        }
        if (!$validator->passes()) {
            return response()->json([
                'error' => true,
                'pesan' => $validator->errors()->all()
            ]);
        }
        $id = $request->id;
        $post = [

            'kode_kategori' => $request->kode_kategori,
            'nama_kategori' => $request->nama_kategori,
        ];


        Kategori::updateOrCreate(['id' => $id], $post);
        return response()->json([
            'success' => true,
            'pesan' => 'Data Berhasil Ditambah',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Kategori::findOrFail($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Kategori::where('id', $id)->delete();
        return response()->json($post);
    }
}
