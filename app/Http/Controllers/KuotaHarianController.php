<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Sa;
use Carbon\Carbon;
use App\Models\Sppbe;
use App\Models\KuotaHarian;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class KuotaHarianController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //
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
        // dd($request->all());
        $validated = $request->validate(
            [
                'tanggal' => 'required',
                'sa_id' => 'required',
                'kuota' => 'required',
            ],
            [
                'kuota.required'  => 'Kuota harian harus diisi.',
            ]
        );


        KuotaHarian::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kuota harian berhasil ditambahkan!',
        ]);

        // dd($request->data);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KuotaHarian  $kuotaHarian
     * @return \Illuminate\Http\Response
     */
    public function show(KuotaHarian $kuotaHarian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KuotaHarian  $kuotaHarian
     * @return \Illuminate\Http\Response
     */
    public function edit(KuotaHarian $kuotaHarian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KuotaHarian  $kuotaHarian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KuotaHarian $kuotaHarian)
    {
        $validated = $request->validate(
            [
                'kuota' => 'required',
            ],
            [
                'kuota.required'  => 'Kuota harian harus diisi.',
            ]
        );


        $kuotaHarian->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kuota harian berhasil diperbarui!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KuotaHarian  $kuotaHarian
     * @return \Illuminate\Http\Response
     */
    public function destroy(KuotaHarian $kuotaHarian)
    {
        try {
            $kuotaHarian->delete();

            $messaage = 'Kuota harian berhasil dihapus';
            $status = 200;
        } catch (Exception $e) {
            $messaage = 'Kuota harian sudah digunakan!';
            $status = 500;
        }

        return response()->json([
            'message' => $messaage
        ], $status);
    } 

    public function getSA(Request $request)
    {

        $data = Sa::with('sppbe')->whereYear('bulan_tahun', $request->tahun)
            ->whereMonth('bulan_tahun', $request->bulan)
            ->where('sppbe_id', $request->sppbe_id)->get();
        // dd($data);
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    
}
