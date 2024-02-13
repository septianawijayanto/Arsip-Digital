<?php

namespace App\Http\Controllers\Cabang;

use App\Http\Controllers\Controller;
use App\Models\Cabang;
use Illuminate\Http\Request;
use Validator;
use File;

class CabangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Cabang';
        $datas = Cabang::all();
        if ($request->ajax()) {
            return datatables()->of($datas)->addIndexColumn()

                ->addColumn('action', function ($data) {
                    $button = '<a href="javascript:void(0)" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="Klik disini untuk mengedit data cabang dengan kode cabang : ' . $data->kode_cabang . '"  data-id="' . $data->id . '" data-original-title="Edit" class="btn btn-warning btn-xs edit-post"><i class="fas fa-pencil-alt"></i> </a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button"  name="delete" id="' . $data->id . '" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="Klik disini untuk menghapus data cabang dengan kode cabang : ' . $data->kode_cabang . '"   class="delete btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $button;
                })->make(true);
        }
        return view('cabang.index', compact('title'));
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
                'kode_cabang' => 'required|unique:cabang|min:3',
                'nama_cabang' => 'required|max:60',
                'alamat' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'kode_cabang' => 'required|unique:cabang,id',
                'nama_cabang' => 'required|max:60',
                'alamat' => 'required',
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

            'kode_cabang' => $request->kode_cabang,
            'nama_cabang' => $request->nama_cabang,
            'alamat' => $request->alamat,
        ];


        Cabang::updateOrCreate(['id' => $id], $post);
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
        $data = Cabang::findOrFail($id);
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
        $post = Cabang::where('id', $id)->delete();
        return response()->json($post);
    }
}
