<?php

namespace App\Http\Controllers;

use datatables;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $pasien = User::get();
        $pasien = User::where('roles','USER')->get();
        if (request()->ajax()) {
            return datatables()->of($pasien)
                ->addColumn('aksi', function ($data) {
                    $button = " <button class='edit edit-jam btn btn-primary  feather icon-edit-1' id='" . $data->id . "' > Edit</button>";
                    $button .= " <button class='hapus btn btn-outline-danger feather icon-trash' id='" . $data->id . "' > Hapus</button>";
                    return $button;
                })
                ->addColumn('photoProfile', 'pasien.photoProfile')
                ->addIndexColumn()
                ->rawColumns(['photoProfile', 'aksi'])
                ->make(true);
        }
        return view('pasien.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule = [
            'name' => 'required',
            // 'email' => 'required|unique:users,email',
            // 'password' =>'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'no_tlp' => 'required',
    
        ];
        $text = [
            'name.required' => 'Kolom nama tidak boleh kosong',
            'email.required' => 'Kolom email tidak boleh kosong',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Kolom password tidak boleh kosong',
            'alamat.required' => 'Kolom alamat tidak boleh kosong',
            'jenis_kelamin.required' => 'Kolom janis kelamin tidak boleh kosong',
            'no_tlp.required' => 'Kolom nomor telepon tidak boleh kosong'
        ];

        $validasi = Validator::make($request->all(), $rule, $text);
        if ($validasi->fails()) {
            return response()->json(['status' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $datas = new User();
        $Id = $request->id;
        $data =[
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_tlp' => $request->no_tlp,
        ];
         
        $datas = User::updateOrCreate(['id' => $Id], $data);  
        if ($datas) {
            return response()->json(['status' => 'Data Berhasil Disimpan', 200]);
        } else {
            return response()->json(['text' => 'Data Gagal Disimpan', 422]);
        } 
        // return response()->json([
        //     	'status' => 200,$datas
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);
        if($data){
            return response()->json($data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $user->delete();
        // return response()->json([
		// 	'status' => 200,
		// ]);
        
        $user = User::where('id',$id)->delete();
     
        return response()->json($user);
    }
}
