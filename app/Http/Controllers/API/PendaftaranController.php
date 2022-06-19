<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dokter_id' => 'required|int|exists:dokters,id',
            'jam_praktek_id' => 'required|int|exists:jam_prakteks,id',
            'tanggal_pendaftaran' => 'required|date',
            'transaksi' => 'required|string',
            'keluhan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return ResponseFormatter::error(['error'=>$validator->errors()], 'Form Validation Error !!!', 401);
        }

        if (pendaftaran::where('user_id', auth()->id())->where('jam_praktek_id', $request->jam_praktek_id)->whereDate('tanggal_pendaftaran', $request->tanggal_pendaftaran)->where('dokter_id', $request->dokter_id)->exists()) {
            return ResponseFormatter::error(null, 'You has been registered in this Docktor !', 401);
        }

        $request['user_id'] = auth()->id();
        $pendaftaran = pendaftaran::firstOrCreate($request->all());
        return ResponseFormatter::success($pendaftaran,'Successfully Registed');
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
