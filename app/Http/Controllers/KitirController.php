<?php

namespace App\Http\Controllers;

use App\Models\Sa;
use Carbon\Carbon;
use App\Models\Kitir;
use App\Models\Sppbe;
use Illuminate\Http\Request;

class KitirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = $request->month ?? Date("Y-m");
        $data = [
            'month' => $date,
            'sppbes' => Sppbe::orderBy('nama')->get(),
            'sas' => Sa::with('sppbe')->whereYear('bulan_tahun', Carbon::create($date)->month)
                ->whereMonth('bulan_tahun', Carbon::create($date)->year)->get(),
            'kitirs' => Kitir::with('sa.sppbe')->whereYear('tanggal', Carbon::create($date)->month)
                ->whereMonth('tanggal', Carbon::create($date)->year)->get(),

        ];
        // dd(Carbon::create($date)->year);
        dd($data);
        return view('pages/kitir/create', $data);
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
            'kitirs' => Kitir::with('sa.sppbe')->orderBy('tanggal')->get(),

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
        $validated = $request->validate([
            'tanggal' => 'required',
            'sppbe_id' => 'required',
            'no_sa' => 'required',
            'kuota' => 'required',
            'tipe' => 'required',
        ]);

        $validated['sisa_kuota'] = $validated['kuota'];
        $kitir = Kitir::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditambahkan!',
            'data' => $kitir->load('sppbe'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kitir  $kitir
     * @return \Illuminate\Http\Response
     */
    public function show(Kitir $kitir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kitir  $kitir
     * @return \Illuminate\Http\Response
     */
    public function edit(Kitir $kitir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kitir  $kitir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kitir $kitir)
    {
        $validated = $request->validate([
            'tanggal' => 'required',
            'sppbe_id' => 'required',
            'no_sa' => 'required',
            'kuota' => 'required',
            'tipe' => 'required',
        ]);

        $kitir->update($validated);

        return response()->json([
            'sucess' => true,
            'message' => 'Data berhasil diupdate!',
            'data' => Kitir::find($kitir->id)->load('sppbe')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kitir  $kitir
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kitir $kitir)
    {
        $kitir->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus!'
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
