<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\hari_praktek;
use App\Models\HariPraktek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HariPraktekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dokter = Dokter::all();
        $data = HariPraktek::all();
        if (request()->ajax()) {
            return datatables()->of($data)
                ->addColumn('aksi', function ($data) {
                    $button = " <button class='edit edit-jam btn btn-primary  feather icon-edit-1' id='" . $data->id . "' > Edit</button>";
                    $button .= " <button class='hapus btn btn-outline-danger feather icon-trash' id='" . $data->id . "' > Hapus</button>";
                    return $button;
                })
                ->addColumn('dokter_id', function($data) {
                    return $data->dokter->nama_dokter;
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('haripraktek.index',compact('dokter'));
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
            'dokter_id' => 'required',
            'hari_praktek' => 'required'
        ];
        $text = [
            'dokter_id.required' => 'Kolom nama dokter tidak boleh kosong',
            'hari_praktek.required' => 'Kolom hari praktek dokter tidak boleh kosong'
        ];

        $validasi = Validator::make($request->all(), $rule, $text);
        if ($validasi->fails()) {
            return response()->json(['status' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        $datas = new HariPraktek();
        $Id = $request->id;
        $data =[
            'dokter_id' => $request->dokter_id,
            'hari_praktek' => $request->hari_praktek,
        ];
        // $data = $data->save();
        $datas = HariPraktek::updateOrCreate(['id' => $Id], $data);


        if ($datas) {
            return response()->json(['status' => 'Data Berhasil Disimpan', 200]);
        } else {
            return response()->json(['text' => 'Data Gagal Disimpan', 422]);
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
        $data = HariPraktek::find($id);
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
        $data = HariPraktek::where('id',$id)->delete();

        return response()->json($data);
    }
}
