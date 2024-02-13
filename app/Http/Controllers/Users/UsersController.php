<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'User';
        $role = Config::where('config_code', 'Role')->get();
        $datas = User::all();
        if ($request->ajax()) {
            return datatables()->of($datas)->addIndexColumn()

                ->addColumn('action', function ($data) {
                    $button = '<a href="javascript:void(0)" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="Klik disini untuk mengedit data user dengan username : ' . $data->username . '"  data-id="' . $data->id . '" data-original-title="Edit" class="btn btn-warning btn-xs edit-post"><i class="fas fa-pencil-alt"></i> </a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button"  name="delete" id="' . $data->id . '" data-dismiss="modal" data-toggle="tooltip" data-placement="top" title="Klik disini untuk menghapus data user dengan username : ' . $data->username . '"   class="delete btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a href="javascript:void(0)" data-dismiss="modal" data-toggle="tooltip" data-placement="top"
                    title="Klik disini untuk mengedit Maksimum Storage User : ' . $data->username . '"  data-id="' . $data->id . '" 
                    data-original-title="Storage Maksimal" class="btn btn-success btn-xs edit-storage"><i class="fas fa-database"></i> </a>';
                    return $button;
                })->make(true);
        }
        return view('user.index', compact('title', 'role'));
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
                'name' => 'required',
                'username' => 'required|unique:users|min:5',
                'email' => 'required|unique:users',
                'role' => 'required',
                'password' => 'required|min:5',
                'gambar' => 'file|mimes:jpg,png,jpeg'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'username' => 'required|unique:users,id',
                'email' => 'required|unique:users,id',
                'role' => 'required',
                'password' => 'required|min:5',
                'gambar' => 'file|mimes:jpg,png,jpeg'
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
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ];

        if ($id != null) {
            if ($gambars = $request->file('gambar')) {
                $gambar = User::where('id', $request->id)->first();
                File::delete('gambar/' . $gambar->gambar);
                $tujuan = 'gambar/';
                $gambarfile = $gambars->getClientOriginalName();
                $gambars->move($tujuan, $gambarfile);
                $post['gambar'] = $gambarfile;
            }
        } else {
            if ($gambars = $request->file('gambar')) {
                $tujuan = 'gambar/';
                $gambarfile = $gambars->getClientOriginalName();
                $gambars->move($tujuan, $gambarfile);
                $post['gambar'] = $gambarfile;
            }
        }
        User::updateOrCreate(['id' => $id], $post);
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
        $data = User::findOrFail($id);
        return response()->json($data);
    }
    public function editStorage(string $id)
    {
        $data = User::findOrFail($id);
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
        $data = User::where('id', $id)->first();
        FIle::delete('gambar/' . $data->gambar);
        $post = User::where('id', $id)->delete();
        return response()->json($post);
    }
    public function edit_password()
    {
        $title = "Reset Password " . Auth::user()->name;
        return view('user.reset', compact('title'));
    }
    public function simpan_password(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|string|min:5|confirmed',
            // 'gambar' => 'file|mimes:jpg,png,jpeg'
        ]);
        $user = User::findorfail(Auth::user()->id);
        if ($request->password_lama) {
            if (Hash::check($request->password_lama, $user->password)) {
                if ($request->password_lama == $request->password) {
                    return redirect()->back()->with('error', 'Maaf password yang anda masukkan sama!');
                } else {
                    $user_password = [
                        'password' => Hash::make($request->password),
                    ];
                    $user->update($user_password);
                    return redirect()->back()->with('sukses', 'Password anda berhasil diperbarui!');
                }
            } else {
                return redirect()->back()->with('gagal', 'Tolong masukkan password lama anda dengan benar!');
            }
        } else {
            return redirect()->back()->with('gagal', 'Tolong masukkan password lama anda terlebih dahulu!');
        }
    }
    public function up_storage(Request $request)
    {
        User::where('id', $request->id2)->update(
            [
                'maksimal_storage' => $request->maksimal_storage
            ]

        );
        return response()->json([
            'success' => true,
            'pesan' => 'Data Berhasil Di Update',
        ]);
    }
}
