<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sa;
use Illuminate\Http\Request;

class SaController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'kitir_id' => 'required',
            'no_sa' => 'required|unique:sas',
            'bulan_tahun' => 'required',
            'tipe' => 'required',
            'sppbe_id' => 'required'
        ],
        [
            'no_sa.required'  => 'No. SA harus diisi.',
            'no_sa.unique'    => 'No. SA sudah ada.'
        ]);


        Sa::create($validated);

        return response()->json(['message' => 'No. SA berhasil ditambahkan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sa  $sa
     * @return \Illuminate\Http\Response
     */
    public function show(Sa $sa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sa  $sa
     * @return \Illuminate\Http\Response
     */
    public function edit(Sa $sa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sa  $sa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sa $sa)
    {
        $validated = $request->validate(
            [
                'no_sa' => 'required|unique:sas,no_sa,' . $sa->id,
                'bulan_tahun' => 'required',
                'tipe' => 'required',
                'sppbe_id' => 'required'
            ],
            [
                'no_sa.required'  => 'No. SA harus diisi.',
                'no_sa.unique'    => 'No. SA sudah digunakan.'
            ]
        );

        $sa->update($validated);

        return response()->json(['message' => 'No. SA berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sa  $sa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sa $sa)
    {
        $sa->delete();

        return response()->json([
            'success' => true,
            'message' => 'No. SA berhasil dihapus!'
        ]);
    }
}
