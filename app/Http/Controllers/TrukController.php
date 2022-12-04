<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Truk;
use App\Models\Sopir;
use App\Models\Kernet;
use Illuminate\Http\Request;

class TrukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'truks' => Truk::with('sopir', 'kernet')->orderBy('kode')->get()
        ];

        return view('pages.truk.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'sopirs' => Sopir::all(),
            'kernets' => Kernet::all(),
        ];

        return view('pages.truk.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|unique:truks,kode',
            'merk' => 'required',
            'plat_nomor' => 'required|unique:truks,plat_nomor',
            'kapasitas' => 'required',
            'sopir_id' => 'required',
            'kernet_id' => 'required',
        ]);

        Truk::create($validated);

        return to_route('armada.truk.index')->with('success', 'Truk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Truk  $truk
     * @return \Illuminate\Http\Response
     */
    public function show(Truk $truk)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Truk  $truk
     * @return \Illuminate\Http\Response
     */
    public function edit(Truk $truk)
    {
        // dd($truk);
        $data = [
            'truk' => $truk,
            'sopirs' => Sopir::all(),
            'kernets' => Kernet::all(),
        ];

        return view('pages.truk.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Truk  $truk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Truk $truk)
    {
        $validated = $request->validate([
            'kode' => 'required|unique:truks,kode,' . $truk->id,
            'merk' => 'required',
            'plat_nomor' => 'required|unique:truks,plat_nomor,' . $truk->id,
            'kapasitas' => 'required',
            'sopir_id' => 'required',
            'kernet_id' => 'required',
        ]);

        $truk->update($validated);

        return to_route('armada.truk.index')->with('success', 'Truk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Truk  $truk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Truk $truk)
    {

        try {
            $truk->delete();
            $messaage = 'Truk berhasil dihapus';
            $status = 200;
        } catch (Exception $e) {
            $messaage = 'Truk gagal dihapus!';
            $status = 500;
        }

        return response()->json([
            'message' => $messaage
        ], $status);
    }
}
