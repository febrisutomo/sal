<?php

namespace App\Http\Controllers;

use App\Models\Kitir;
use App\Models\Sopir;
use App\Models\Armada;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
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
            'pengambilans' => Pengambilan::with('kitir.sa', 'armada', 'penyalurans',)->get()
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
            'kitirs' => Kitir::with('sa.sppbe')->where('tanggal', date('Y-m-d'))->get(),
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
        // dd($request->penukaran);

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


        foreach ($request->penyaluran as $data) {
            $pengambilan->penyalurans()->attach($data['pangkalan_id'], [
                'harga' => 14500,
                'kuantitas' => $data['jumlah']
            ]);
        }

    

        foreach ($request->penukaran as $data) {
            $pengambilan->penukarans()->create(
                [
                    'no_seri' => $data['no_seri'],
                    'rincian' => $data['rincian']
                ] 
            );
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
    public function show(Pengambilan $pengambilan)
    {
        $data = [
            'pengambilan' => $pengambilan->load('kitir.sa.sppbe', 'armada', 'penyalurans'),
        ];

        return view('pages/surat-jalan/detail', $data);
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

    public function pdf(Pengambilan $pengambilan)
    {
        // dd($pengambilan);
        $data = [
            'pengambilan' => $pengambilan->load('kitir.sa.sppbe', 'armada', 'penyalurans'),
        ];

        // return view('pages/surat-jalan/pdf', $data);
        
        $pdf = PDF::loadView('pages/surat-jalan/pdf', $data);
     
        // return $pdf->download('surat-jalan-'.$pengambilan->id.'.pdf');
        return $pdf->stream();
    }
}
