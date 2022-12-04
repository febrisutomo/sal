<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Sppbe;
use Illuminate\Http\Request;

class SppbeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'sppbes' => Sppbe::all()
        ];

        return view('pages.sppbe.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.sppbe.create');
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
            'nama' => 'required|unique:sppbes,nama',
            'kode' => 'required|unique:sppbes,kode',
            'no_sh' => 'required|unique:sppbes,no_sh',
            'plant' => 'required|unique:sppbes,plant',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        Sppbe::create($validated);

        return to_route('sppbe.index')->with('success', 'SP(P)BE berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sppbe  $sppbe
     * @return \Illuminate\Http\Response
     */
    public function show(Sppbe $sppbe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sppbe  $sppbe
     * @return \Illuminate\Http\Response
     */
    public function edit(Sppbe $sppbe)
    {

        $data = [
            'sppbe' => $sppbe
        ];
        return view('pages.sppbe.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sppbe  $sppbe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sppbe $sppbe)
    {
        $validated = $request->validate([
            'nama' => 'required|unique:sppbes,nama,'.$sppbe->id,
            'kode' => 'required|unique:sppbes,kode,'.$sppbe->id,
            'no_sh' => 'required|unique:sppbes,no_sh,'.$sppbe->id,
            'plant' => 'required|unique:sppbes,plant,'.$sppbe->id,
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        $sppbe->update($validated);

        return to_route('sppbe.index')->with('success', 'SP(P)BE berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sppbe  $sppbe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sppbe $sppbe)
    {
        try {
            $sppbe->delete();

            $messaage = 'SP(P)BE berhasil dihapus';
            $status = 200;
        } catch (Exception $e) {
            $messaage = 'SP(P)BE gagal dihapus!';
            $status = 500;
        }

        return response()->json([
            'message' => $messaage
        ], $status);
    }
}
