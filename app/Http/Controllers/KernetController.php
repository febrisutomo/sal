<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Kernet;
use Illuminate\Http\Request;

class KernetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.kernet.index', [
            'kernets' => Kernet::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.kernet.create',);
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
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        Kernet::create($validated);

        return to_route('armada.kernet.index')->with('success', 'Kernet berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kernet  $kernet
     * @return \Illuminate\Http\Response
     */
    public function show(Kernet $kernet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kernet  $kernet
     * @return \Illuminate\Http\Response
     */
    public function edit(Kernet $kernet)
    {
        return view('pages.kernet.edit', [
            'kernet' => $kernet,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kernet  $kernet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kernet $kernet)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);

        $kernet->update($validated);

        return to_route('armada.kernet.index')->with('success', 'Kernet berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kernet  $kernet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kernet $kernet)
    {
        try {
            $kernet->delete();
            $messaage = 'Kernet berhasil dihapus';
            $status = 200;
        } catch (Exception $e) {
            $messaage = 'Kernet gagal dihapus!';
            $status = 500;
        }

        return response()->json([
            'message' => $messaage
        ], $status);
    }
}
