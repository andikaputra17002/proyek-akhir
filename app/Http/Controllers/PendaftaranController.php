<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dokter;
use App\Models\JamPraktek;
use App\Models\pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pasien = User::where('roles','USER')->get();
        $dokter = Dokter::all();
        $jampraktek = JamPraktek::all();
        $data = pendaftaran::query();
        if ($request->fildok != null) {
            $data = $data->where('dokter_id', $request->get('fildok'));
        } 
        if ($request->filjam != null) {
            $data = $data->where('jam_praktek_id', $request->get('filjam'));
        }
        $data =$data->whereDate('tanggal_pendaftaran', Carbon::today())->get();
        if (request()->ajax()) {
            return datatables()->of($data)
                ->addColumn('aksi', function ($data) {
                    $button = " <button class='edit edit-jam btn btn-primary  feather icon-mic' id='" . $data->id . "' > Periksa</button>";
                    return $button;
                })
                ->addColumn('user_id', function($data) {
                    return $data->user->name;
                })
                ->addColumn('dokter_id', function($data) {
                    return $data->dokter->nama_dokter;
                })
                ->addColumn('jam_praktek_id', function($data) {
                    return $data->jam_praktek->jam_praktek;
                })
                ->rawColumns(['aksi'])
                ->addIndexColumn()
                ->make(true);
                // 
        }
        
        return view('datapendaftaran.index',compact('pasien','dokter', 'jampraktek'));
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

    private function getNoAntrian(){
        // $jumlah_hari_ini = pendaftaran::where('tanggal_pendaftaran',date('Y-m-d'))
        $tanggal = pendaftaran::where('tanggal_pendaftaran',Carbon::now()->format('Y-m-d'))
        ->count();
        // $no = pendaftaran::where('dokter_id','=',$tanggal)->count();

        $ditambah_satu = $tanggal + 1;
        // $ditambah_satu = $no + 1;

        $hasil = "";
        if($tanggal >= 100)
        {
            $hasil = "A".$ditambah_satu;
        }else if($tanggal >= 10 && $tanggal < 100)
        {
            $hasil = "A-0".$ditambah_satu;
        }else{
            $hasil = "A-00".$ditambah_satu;
        }

        return $hasil;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ddd($datas);
        $rule = [
            'name' => 'required',
            'nama_dokter' => 'required',
            'tanggal_pendaftaran' => 'required',
            'jam_praktek' => 'required',
            'transaksi' => 'required',
    
        ];
        $text = [
            'name.required' => 'Kolom nama tidak boleh kosong',
            'nama_dokter.required' => 'Kolom nama dokter tidak boleh kosong',
            'tanggal_pendaftaran.required' => 'Kolom tanggal pendaftaran tidak boleh kosong',
            'transaksi.required' => 'Kolom transaksi tidak boleh kosong',
        ];

        $validasi = Validator::make($request->all(), $rule, $text);
        if ($validasi->fails()) {
            return response()->json(['status' => 0, 'text' => $validasi->errors()->first()], 422);
        }

        
        $datas = new pendaftaran();
        // $dokter = pendaftaran::max('antrian');
        //     if (!$dokter) {
        //         return 'A001';
        //     } else {
        //         $dokter + 1;
        //     }

        // $nomor = pendaftaran::select('antrian')
        // ->where([
        //     ['dokter_id', '=', $request->nama_dokter],
        //     ['jam_praktek_id', '=', $request->jam_praktek],
        //     ['tanggal_pendaftaran', '=', $request->tanggal_pendaftaran ]
        // ])->count()+1;
        // ->select('pendaftaran_id', DB::raw('co(points) as total_points'))
        // ->get();
        // $no = count($nomor + 1);

        $Id = $request->id;
        $tanggal_pendaftaran = Carbon::parse( $request->tanggal_pendaftaran)->format('Y-m-d');
        $data =[
            'user_id' => $request->name,
            'dokter_id' => $request->nama_dokter,
            'tanggal_pendaftaran' => $tanggal_pendaftaran,
            'jam_praktek_id' => $request->jam_praktek,
            'transaksi' => $request->transaksi,
            'antrian' => $this->getNoAntrian(),
        ];
         
        $datas = pendaftaran::updateOrCreate(['id' => $Id], $data);  
        // ddd($datas); 
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
        //
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
        //
    }
}
