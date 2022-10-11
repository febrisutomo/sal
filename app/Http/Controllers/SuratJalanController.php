<?php

namespace App\Http\Controllers;

use App\Models\Kitir;
use App\Models\Sopir;
use App\Models\Armada;
use App\Models\Pangkalan;
use App\Models\Pengambilan;
use Illuminate\Http\Request;

class SuratJalanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'pengambilans' => Pengambilan::with('kitir.sa', 'armada', 'penyaluran', )->get()
        ];
        // dd($data);
        return view('pages/surat-jalan/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'armadas' => Armada::all(),
            'sopirs' => Sopir::all(),
            'pangkalans' => Pangkalan::orderBy('nama')->get(),
            'kitirs' => Kitir::with( 'sa.sppbe')->where('tanggal', date('Y-m-d'))->get(),
        ];

        return view('pages/surat-jalan/create', $data);
    }

    public function getSA($tanggal)
    {
        $data = [
            'success' => true,
            'data' => Kitir::with('sa.sppbe')->where('tanggal', $tanggal)->get()
        ];

        return response()->json($data);
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
                'kitir_id' => 'required',
                'armada_id' => 'required',
                'sopir_id' => 'required',
                'penyaluran' => 'required',
            ]
        );

        $pengambilan = Pengambilan::create($validated);

        $pengambilan->kitir()->decrement('sisa_kuota', 560);

        $penyaluran = $pengambilan->penyaluran()->create();

        foreach ($request->penyaluran as $data) {
            $penyaluran->pangkalans()->attach($data['pangkalan_id'], [
                'harga' => 14500,
                'kuantitas' => $data['jumlah']
            ]);
        }

        return to_route('surat-jalan.index');


        // dd("berhasil");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
