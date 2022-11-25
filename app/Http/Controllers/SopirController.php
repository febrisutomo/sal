<?php

namespace App\Http\Controllers;

use App\Http\Traits\UploadFileTrait;
use App\Models\Sopir;
use Illuminate\Http\Request;

class SopirController extends Controller
{
    
    use UploadFileTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('pages.sopir.index', [
            'sopirs' => Sopir::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.sopir.create');
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
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'ttd' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        $fileName = $this->uploadFile($request->file('ttd'), 'img/sopir/');

        $validated['ttd'] = $fileName;

        Sopir::create($validated);

        return to_route('armada.sopir.index')->with('success', 'Sopir berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sopir  $sopir
     * @return \Illuminate\Http\Response
     */
    public function show(Sopir $sopir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sopir  $sopir
     * @return \Illuminate\Http\Response
     */
    public function edit(Sopir $sopir)
    {
        return view('pages.sopir.edit', [
            'sopir' => $sopir
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sopir  $sopir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sopir $sopir)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'ttd' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->file('ttd')) {
            $fileName = $this->uploadFile($request->file('ttd'), 'img/sopir/');
            
            $this->deleteFile($sopir->ttd, 'img/sopir');

        }
        else{
            $fileName = $sopir->ttd;
        }

        $validated['ttd'] = $fileName;

        $sopir->update($validated);


        return to_route('armada.sopir.index')->with('success', 'Sopir berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sopir  $sopir
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sopir $sopir)
    {
        $sopir->delete();

        $this->deleteFile($sopir->ttd, 'img/sopir');

        return response()->json([
            'success' => true,
            'message' => 'Sopir berhasil dihapus!'
        ]);
    }

    
}
