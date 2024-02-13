<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Validator;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Menu';
        $datas = Menu::all();
        if ($request->ajax()) {
            return datatables()->of($datas)->addIndexColumn()

                ->addColumn('action', function ($data) {
                    $button = '<a href="javascript:void(0)" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="Klik disini untuk mengedit data menu dengan nama : ' . $data->display_menu . '"  data-id="' . $data->id . '" data-original-title="Edit" class="btn btn-warning btn-xs edit-post"><i class="fas fa-pencil-alt"></i> </a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button"  name="delete" id="' . $data->id . '" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="Klik disini untuk menghapus data menu dengan nama : ' . $data->display_menu . '"   class="delete btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    return $button;
                })->make(true);
        }
        return view('menu.index', compact('title'));
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
                'url' => 'required|unique:menu|min:3|max:60',
                'display_menu' => 'required|max:60',
                'controller' => 'required|max:60',
                'posisi' => 'required',
                'nourut' => 'required|numeric',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'url' => 'required|unique:menu,id',
                'display_menu' => 'required|max:60',
                'controller' => 'required|max:60',
                'posisi' => 'required',
                'nourut' => 'required|numeric',
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

            'display_menu' => $request->display_menu,
            'url' => $request->url,
            'controller' => $request->controller,
            'posisi' => $request->posisi,
            'nourut' => $request->nourut
        ];


        Menu::updateOrCreate(['id' => $id], $post);
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
        $data = Menu::findOrFail($id);
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
        $post = Menu::where('id', $id)->delete();
        return response()->json($post);
    }
}
