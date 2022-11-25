<?php

namespace App\Http\Controllers;

use App\Models\Pangkalan;
use Illuminate\Http\Request;

class PangkalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'pangkalans' => Pangkalan::all()
        ];
        return view('pages.pangkalan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.pangkalan.create');
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
            'nama' => 'required',
            'no_reg' => 'required|unique:pangkalans,no_reg',
            'kuota' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        Pangkalan::create($validated);

        return to_route('pangkalan.index')->with('success', 'Pangkalan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pangkalan  $pangkalan
     * @return \Illuminate\Http\Response
     */
    public function show(Pangkalan $pangkalan)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pangkalan  $pangkalan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pangkalan $pangkalan)
    {
        $data = [
            'pangkalan' => $pangkalan
        ];

        return view('pages.pangkalan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pangkalan  $pangkalan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pangkalan $pangkalan)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'no_reg' => 'required|unique:pangkalans,no_reg,'.$pangkalan->id,
            'kuota' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        $pangkalan->update($validated);

        return to_route('pangkalan.index')->with('success', 'Pangkalan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pangkalan  $pangkalan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pangkalan $pangkalan)
    {
        $pangkalan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pangkalan berhasil dihapus!'
        ]);
    }
}
