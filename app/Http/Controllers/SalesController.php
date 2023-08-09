<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMssalesmanRequest;
use App\Http\Requests\UpdateMssalesmanRequest;
use App\Models\Mssalesman;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json(Mssalesman::all(), 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'error'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMssalesmanRequest $request)
    {
        try {
            $latestRecord = Mssalesman::latest('sal_id')->first();

            $data = $request->validated();

            $input = Mssalesman::create([
                'sal_id' => sprintf("S%03d", intval(substr($latestRecord->sal_id, 1)) + 1),
                'sal_nm' => strtoupper($data['nama']),
                'mskota_kta_id' => strtoupper($data['kota']),
                'sal_bekerjasejak' => $data['bekerja_sejak']
            ]);

            return response()->json(['message' => 'sales berhasil di tambahkan', 'data' => $input], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'oopps'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Mssalesman $mssalesman)
    {
        try {
            return response()->json($mssalesman, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'error'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMssalesmanRequest $request, Mssalesman $mssalesman)
    {
        try {
            $data = $request->validated();

            $mssalesman->sal_nm = strtoupper($data['nama']);
            $mssalesman->mskota_kta_id = strtoupper($data['kota']);
            $mssalesman->sal_bekerjasejak = strtoupper($data['bekerja_sejak']);
            $mssalesman->save();

            return response()->json(['message' => 'sales berhasil diupdate'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'ooppss'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mssalesman $mssalesman)
    {
        try {
            $coba = Mssalesman::with(['jual'])->where('sal_id', $mssalesman->sal_id)->get();

            if(count($coba[0]['jual']) === 0){
                $mssalesman->delete();
                return response()->json(['message' => 'sales berhasil dihapus'], 200);
            }

            return response()->json(['message' => 'data penjual ada'], 400);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'ooppss'], 500);
        }
    }
}
