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
                    $button = " <button class='edit btn btn-primary feather icon-edit-1' id='" . $dokter->id . "' >Edit</button>";
                    $button .= " <button class='hapus btn btn-outline-danger feather icon-trash' id='" . $dokter->id . "' >Hapus</button>";
                    return $button;
                })
                ->addColumn('photo_dokter', 'dokter.photo_dokter')
                // ->addColumn('aksi', 'dokter.aksi')
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
        $rule = [
            'nama_dokter' => 'required',
            'bidang_dokter' =>'required',
            'hari_praktek' => 'required',
            'jam_praktek_pagi' =>'required',
            'jam_praktek_malam' =>'required',
            'photo_dokter' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
        $text = [
            'nama_dokter.required' => 'Kolom nama dokter tidak boleh kosong',
            'bidang_dokter.required' => 'Kolom bidang dokter tidak boleh kosong',
            'hari_praktek.required' => 'Kolom hari praktek tidak boleh kosong',
            'jam_praktek_pagi.required' => 'Kolom jam praktek tidak boleh kosong',
            'jam_praktek_malam.required' => 'Kolom jam praktek tidak boleh kosong',
        ];

        $validasi = Validator::make($request->all(), $rule, $text);
        if ($validasi->fails()) {
            return response()->json(['status' => 0, 'text' => $validasi->errors()->first()], 422);
        }

            $datas = new Dokter();
            $Id = $request->id;
            $data =[
                'nama_dokter' => $request->nama_dokter,
                'bidang_dokter' => $request->bidang_dokter,
                // 'jam_praktek_pagi' => $request->jam_praktek_pagi,
                // 'jam_praktek_malam' => $request->jam_praktek_malam,
                'hari_praktek' => implode(' , ' , $request->hari_praktek),
                'jam_praktek_pagi' =>implode(' , ', $request->jam_praktek_pagi),
                'jam_praktek_malam' =>implode(' , ', $request->jam_praktek_malam),

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
            if ($datas) {
                return response()->json(['status' => 'Data Berhasil Disimpan', 200]);
            } else {
                return response()->json(['text' => 'Data Gagal Disimpan', 422]);
            }
            // $data = $data->save();
            // return response()->json([
            //         'status' => 200,$datas
            //         // 'code'=>1,$datas
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
