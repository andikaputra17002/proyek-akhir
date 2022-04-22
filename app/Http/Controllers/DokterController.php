<?php

namespace App\Http\Controllers;

use DB;
use datatables;
use App\Models\Dokter;
use App\Models\JamPraktek;
// use App\Http\Requests\DokterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function index()
    {
        
        $datta = JamPraktek::all();
        // $dokter = Dokter::all();
        // $pilih = $dokter->pluck('jam_praktek')->toArray();
        if (request()->ajax()) {
            return datatables()->of(Dokter::all())
                ->addColumn('aksi', function ($dokter) {
                    $button = " <button class='edit btn btn-primary  feather icon-edit-1' id='" . $dokter->id . "' > Edit</button>";
                    $button .= " <button class='hapus btn btn-outline-danger feather icon-trash' id='" . $dokter->id . "' > Hapus</button>";
                    return $button;
                })
                
                ->addColumn('photo_dokter', 'dokter.photo_dokter')
                ->rawColumns(['aksi','photo_dokter'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('dokter.index', compact('datta'));
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

        // request()->validate([
        //     'photoProfile' => 'image|mimes:jpeg,png,jpg|max:2048',
        //     'nama_dokter' => 'required', 'string', 'max:255',
        //     'bidang_dokter' => 'required', 'string', 'max:255',
        //     // 'hari' => 'required', 'string', 'max:255',
        //     // 'jam' => 'required', 'string', 'max:255',
        // ]);
        $validator = Validator::make($request->all(),[
            'nama_dokter' => 'required', 'string', 'max:255',
            'bidang_dokter' => 'required', 'string', 'max:255',
         ]
        //  ,[
        //      'nama_dokter.required'=>'Product name is required',
        //      'bidang_dokter.required'=>'Product name is required',
        //     //  'product_name.string'=>'Product name must be a string',
        //     //  'product_name.unique'=>'This product name is already taken',
        //     //  'product_image.required'=>'Product image is required',
        //     //  'product_image.image'=>'Product file must be an image',
        //  ]
        );

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }else {
            $datas = new Dokter();
            $Id = $request->id;
            $data =[
                'nama_dokter' => $request->nama_dokter,
                'bidang_dokter' => $request->bidang_dokter,
                'hari_praktek' => implode(' , ' , $request->hari_praktek),
                'jam_praktek' =>implode(' , ', $request->jam_praktek),
    
            ];
            if ($files = $request->file('photo_dokter')) {
                //delete old file
                \File::delete('public/photo_dokter/'.$request->hidden_image);
                
                //insert new file
                $destinationPath = 'public/photo_dokter/'; // upload path
                $profileImage = time() . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
                $data['photo_dokter'] = "$profileImage";
            }
             
            $datas = Dokter::updateOrCreate(['id' => $Id], $data);  
            // $data = $data->save();
            return response()->json([
                    'status' => 200,$datas
                    // 'code'=>1,$datas
            ]);
         }

        
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
        $data = Dokter::find($id);
        return response()->json($data);
        // dd($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // $data = $request->all();
        // $dok= Dokter::find($request->id);
        // $dok->nama_dokter = $request->nama_dokter;
        // $dok->bidang_dokter = $request->bidang_dokter;
        // $dok->hari_praktek = implode(' , ' , $request->hari_praktek);
        // $dok->jam_praktek = implode(' , ', $request->jam_praktek);
        
        // if($request->file('photo_dokter'))
        // {
        //     $dok['photo_dokter'] = $request->file('photo_dokter')->store('assets/user', 'public');
        // }

        // $dok->update();
        // return response()->json([
		// 	'status' => 200,
		// ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dokter $dokter)
    {
        $dokter->delete();
        return response()->json([
			'status' => 200,
		]);
    }
}
