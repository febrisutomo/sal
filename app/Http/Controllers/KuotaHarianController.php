<?php

namespace App\Http\Controllers;

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
        $data = [
            'sppbes' => Sppbe::orderBy('nama')->get(),
            'kuota_harians' => KuotaHarian::with('sa.sppbe')->orderBy('tanggal')->get(),

        ];
        // dd($data);
        return view('pages/kitir/create', $data);
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
                'kuota.required'  => 'Kuota harus diisi.',
            ]
        );

        $validated['sisa_kuota'] = $validated['kuota'];

        KuotaHarian::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kuota berhasil ditambahkan!',
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
        $request->validate(
            [
                'kuota' => 'required',
            ],
            [
                'kuota.required'  => 'Kuota harus diisi.',
            ]
        );

        $kuotaHarian->update(['kuota' => $request->kuota, 'sisa_kuota' => $request->kuota]);

        return response()->json([
            'success' => true,
            'message' => 'Kuota berhasil diubah!',
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
        $kuotaHarian->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kuota berhasil dihapus!'
        ]);
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
