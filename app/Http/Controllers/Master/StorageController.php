<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Storage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
use File;
use Illuminate\Support\Facades\Auth;

class StorageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Storage';
        $kategori = Kategori::get();
        $getRow = Storage::orderBy('id', 'DESC')->get();
        $rowCount = $getRow->count();

        $lastId = $getRow->first();

        $kode = "AR00001";

        if ($rowCount > 0) {
            if ($lastId->id < 9) {
                $kode = "AR0000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 99) {
                $kode = "AR000" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 999) {
                $kode = "AR00" . '' . ($lastId->id + 1);
            } else if ($lastId->id < 9999) {
                $kode = "AR0" . '' . ($lastId->id + 1);
            } else {
                $kode = "AR" . '' . ($lastId->id + 1);
            }
        }

        $datas = Storage::all();
        if ($request->ajax()) {
            return datatables()->of($datas)->addIndexColumn()
                ->addColumn('kategori', function ($data) {
                    return $data->kategori->nama_kategori;
                })->addColumn('size', function ($data) {
                    return formatFileSize($data->size);
                })->addColumn('siapa', function ($data) {
                    return $data->user->name;
                })
                ->addColumn('action', function ($data) {
                    $button = '<a href="storage/' . $data->id . '"  data-toggle="tooltip" data-placement="top" title="Klik disini untuk mengedit data dengan kode  : ' . $data->kode_storage . '"  data-id="' . $data->id . '" data-original-title="Edit" class="btn btn-success btn-xs edit-post"><i class="fas fa-search"></i> </a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a href="javascript:void(0)" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="Klik disini untuk mengedit data dengan kode  : ' . $data->kode_storage . '"  data-id="' . $data->id . '" data-original-title="Edit" class="btn btn-warning btn-xs edit-post"><i class="fas fa-pencil-alt"></i> </a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button"  nama="delete" id="' . $data->id . '" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="Klik disini untuk menghapus data dengan kode : ' . $data->kode_storage . '"   class="delete btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $button;
                })->make(true);
        }
        return view('storage.index', compact('title', 'kategori', 'kode'));
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
                'nama' => 'required|max:60',
                'kode_storage' => 'required|unique:storage|min:5|max:20',
                'deskripsi' => 'required',
                'file' => 'file|mimes:jpg,png,jpeg,pdf,docx,doc,xls,xlsx',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'nama' => 'required:max:60',
                'kode_storage' => 'required|unique:storage,id',
                'deskripsi' => 'required',
                'file' => 'file|mimes:jpg,png,jpeg,pdf,docx,doc,xls,xlsx',
            ]);
        }
        if (!$validator->passes()) {
            return response()->json([
                'error' => true,
                'pesan' => $validator->errors()->all()
            ]);
        }
        $id = $request->id;
        // Mendapatkan objek file dari permintaan
        $file = $request->file('file');

        // Mendapatkan ukuran file dalam bytes
        $fileSizeInBytes = $file->getSize();

        $post = [
            'nama' => $request->nama,
            'user_id' => Auth::user()->id,
            'kode_storage' => $request->kode_storage,
            'kategori_id' => $request->kategori_id,
            'tanggal' => Carbon::now(),
            'deskripsi' => $request->deskripsi,
            'size' => $fileSizeInBytes,
        ];

        if ($id != null) {
            if ($files = $request->file('file')) {
                $file = Storage::where('id', $request->id)->first();
                File::delete('file/' . $file->file);
                $tujuan = 'file/';
                $gambarfile = $files->getClientOriginalName();
                $files->move($tujuan, $gambarfile);
                $post['file'] = $gambarfile;
            }
        } else {
            if ($files = $request->file('file')) {
                $tujuan = 'file/';
                $gambarfile = $files->getClientOriginalName();
                $files->move($tujuan, $gambarfile);
                $post['file'] = $gambarfile;
            }
        }
        Storage::updateOrCreate(['id' => $id], $post);
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
        $data = Storage::find($id);
        $title = "Detail $data->kode_storage";

        return view('storage.show', compact('data', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Storage::findOrFail($id);
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
        $data = Storage::where('id', $id)->first();
        FIle::delete('file/' . $data->file);
        $post = Storage::where('id', $id)->delete();
        return response()->json($post);
    }
}
