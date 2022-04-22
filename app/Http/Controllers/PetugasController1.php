<?php

namespace App\Http\Controllers;

// use App\Http\Requests\UserRequest;
use datatables;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
// use File;

class PetugasController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $petugas = User::where('roles','ADMIN')->get();
        if (request()->ajax()) {
            return datatables()->of($petugas)
                ->addColumn('aksi', 'petugas.aksi')
                ->addColumn('photoProfile', 'petugas.photoProfile')
                ->rawColumns(['aksi', 'photoProfile'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('petugas.index');
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
        // ddd($request);

        request()->validate([
            'photoProfile' => 'image|mimes:jpeg,png,jpg|max:2048',
            // 'name' => 'required', 'string', 'max:255',
            // 'email' => 'required', 'string', 'email', 'max:255',
            // // 'password' => 'required|confirmed',
            // 'alamat' => 'required', 'string',
            // 'roles' => 'required', 'string', 'max:255',
            // 'jenis_kelamin' => 'required', 'string', 'max:255',
            // 'no_tlp' => 'required', 'string', 'max:255',
        ]);

        $data = new User();
        // $data = $request->id;
        // if ($files = $request->file('photoProfile')) {
            
        //     //delete old file
        //     // \File::delete('public/files/'.$request->hidden_image);
            
        //     //insert new file
        //     // $destinationPath = 'public/files/'; // upload path
        //     // $profileImage = time() . "." . $files->getClientOriginalExtension();
        //     // $files->move($destinationPath, $profileImage);
        //     // $details['photoProfile'] = "$profileImage";
        //     // =============================
        //     $path = 'files/';
        //     $file = $request->file('photoProfile');
        //     $file_name = time().'.'.$file->getClientOriginalExtension();
        //     $files->storeAs($path, $file_name, 'public');
        // }
        // $pass = if ($request->password != null) {
        //         $dataId->password = Hash::make($request->password);
        //     }
        // $data =[
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'password' => Hash::make($request->password),
        //         'alamat' => $request->alamat,
        //         'roles' => $request->roles,
        //         'jenis_kelamin' => $request->jenis_kelamin,
        //         'no_tlp' => $request->no_tlp,
        //         'photoProfile' => $file_name,
        //     ];
        // $data->name = $request->name;
        // $data->email = $request->email;
        // $data->alamat = $request->alamat;
        // $data->roles = $request->roles;
        // $data->jenis_kelamin = $request->jenis_kelamin;
        // $data->no_tlp = $request->no_tlp;
        // $data->photoProfile = $file_name;
        // if ($request->password != null) {
        //     $data->password = Hash::make($request->password);
        // }
        
        // $user = User::updateOrCreate(['id' => $data], $data);  
           
        // return Response()->json($user);
        // =======================================================
        // ddd($request);
        // $data = $request->all();
        // $data = new User();
        // $path = 'files/';
        // $file = $request->file('photoProfile');
        // $file_name = time().'.'.$file->getClientOriginalExtension();
        // $file->storeAs($path, $file_name, 'public');
        // // ==========================
        // // $file = $request->file('photoProfile');
        // // if ($file != null) {
        // //     $image = time() . '.' . $file->getClientOriginalExtension();
        // //     $file->storeAs('public/images', $image);
        // // }
        // // ==========================
        if ($request->file('photoProfile')) {
            $data['photoProfile'] = $request->file('photoProfile')->store('files', 'public');
        }
        $data->name = $request->name;
        $data->email = $request->email;
        $data->alamat = $request->alamat;
        $data->roles = $request->roles;
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->no_tlp = $request->no_tlp;
        // $data->photoProfile = $;
        if ($request->password != null) {
            $data->password = Hash::make($request->password);
        }
        $data = $data->save();
        // User::create($data);
        // return response()->json([
        //     'status' => 200,
		// ]);
        return redirect()->route('user.index');
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
        //  return response()->json($data);
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
        // ddd($request);
        // $filename ='';
        
        // $data = User::find($request->id);
        // if ($request->hasFile('photoProfile')) {
        //     $path = 'files/';
		// 	$file = $request->file('photoProfile');
		// 	$filename = time() . '.' . $file->getClientOriginalExtension();
		// 	$file->storeAs($path, $filename, 'public');
		// 	if ($data->photoProfile) {
        //         \file::delete('public/files/' . $data->photoProfile);
		// 	}
		// } else {
        //     $filename = $request->data_photoProfile;
		// }
        if ($request->file('photoProfile')) {
            $data['photoProfile'] = $request->file('photoProfile')->store('files', 'public');
        }
        $data->name = $request->name;
        $data->email = $request->email;
        $data->alamat = $request->alamat;
        $data->roles = $request->roles;
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->no_tlp = $request->no_tlp;
        // $data->photoProfile = $filename;
        $data->password = Hash::make($request->password);
        // if ($request->password != null) {
        // }
        // $data =[
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => $request->password,
        //     'alamat' => $request->alamat,
        //     'roles' => $request->roles,
        //     'jenis_kelamin' => $request->jenis_kelamin,
        //     'no_tlp' => $request->no_tlp,
        //     'photoProfile' => $file_name,
        // ];
        

        $data->update();

        // return redirect()->route('petugas.index');
        return response()->json([
			'status' => 200,
		]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
			'status' => 200,
		]);
        
    }
}
