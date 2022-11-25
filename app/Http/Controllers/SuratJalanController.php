<?php

namespace App\Http\Controllers;

use App\Models\Sopir;
use App\Models\Sppbe;
use App\Models\Truk;
use App\Models\Kernet;
use App\Models\Pangkalan;
use App\Models\KuotaHarian;
use App\Models\Pengambilan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

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
            'pengambilans' => Pengambilan::with('kuotaHarian.sa', 'truk')->get()->sortByDesc(function ($query) {
                return $query->kuotaHarian->tanggal;
            })
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
            'truks' => Truk::all(),
            'sopirs' => Sopir::all(),
            'sppbes' => Sppbe::all(),
            'kernets' => Kernet::all(),
            'pangkalans' => Pangkalan::orderBy('nama')->get(),
            'kuotaHarians' => KuotaHarian::with('sa.sppbe')->where('tanggal', date('Y-m-d'))->get(),
        ];

        return view('pages/surat-jalan/create', $data);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate(
            [
                'sppbe_id' => 'required',
                'kuota_harian_id' => 'required',
                'truk_id' => 'required',
                'sopir_id' => 'required',
                'kernet_id' => 'required',
                'penyaluran' => 'required',
            ]
        );

        DB::beginTransaction();

        try {
            $pengambilan = Pengambilan::create($validated);

            $pengambilan->kuotaHarian()->decrement('sisa_kuota', 560);

            $penyalurans = [];
            foreach ($request->penyaluran as $data) {
                $penyalurans[$data['pangkalan_id']] =  [
                    'harga' => 14500,
                    'kuantitas' => $data['jumlah']
                ];
            }

            $pengambilan->penyalurans()->attach($penyalurans);


            if ($request->penukaran) {
                foreach ($request->penukaran as $data) {
                    $pengambilan->penukarans()->create(
                        [
                            'no_seri' => $data['no_seri'],
                            'rincian' => $data['rincian']
                        ]
                    );
                }
            }


            DB::commit();

            return to_route('surat-jalan.show', $pengambilan)->with('success', 'Surat Jalan berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();

            return to_route('surat-jalan.index')->with('warning', 'Terjadi kesalahan!');;
        }
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
            'pengambilan' => $pengambilan->load('kuotaHarian.sa.sppbe', 'truk', 'penyalurans'),
        ];

        return view('pages/surat-jalan/show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengambilan $pengambilan)
    {

        $data = [
            'sppbes' => Sppbe::all(),
            'truks' => Truk::all(),
            'sopirs' => Sopir::all(),
            'kernets' => Kernet::all(),
            'pangkalans' => Pangkalan::orderBy('nama')->get(),
            'pengambilan' => $pengambilan->load('kuotaHarian.sa.sppbe')
        ];

        return view('pages/surat-jalan/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengambilan $pengambilan)
    {
        
        $validated = $request->validate(
            [
                'kuota_harian_id' => 'required',
                'truk_id' => 'required',
                'sppbe_id' => 'required',
                'sopir_id' => 'required',
                'kernet_id' => 'required',
                'penyaluran' => 'required',
            ]
        );

        // DB::beginTransaction();

        // try {
            $oldKuotaHarian = $pengambilan->kuotaHarian;
            $pengambilan->update($validated);

            if ($request->kuota_harian_id != $oldKuotaHarian->id) {
                $pengambilan->kuotaHarian()->decrement('sisa_kuota', 560);
                $oldKuotaHarian->increment('sisa_kuota', 560);
            }

            $penyalurans = [];
            foreach ($request->penyaluran as $data) {
                $penyalurans[$data['pangkalan_id']] =  [
                    'harga' => 14500,
                    'kuantitas' => $data['jumlah']
                ];
            }

            $pengambilan->penyalurans()->sync($penyalurans);



            $pengambilan->penukarans()->delete();

            if ($request->penukaran) {
                foreach ($request->penukaran as $data) {
                    $pengambilan->penukarans()->create(
                        [
                            'no_seri' => $data['no_seri'],
                            'rincian' => $data['rincian']
                        ]
                    );
                }
            }


            // DB::commit();

            return to_route('surat-jalan.show', $pengambilan)->with('success', 'Surat Jalan berhasil diubah!');
        // } catch (\Exception $e) {
        //     DB::rollBack();

        //     return to_route('surat-jalan.show', $pengambilan)->with('warning', 'Surat Jalan gagal diubah!');
        // }
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

    public function print(Pengambilan $pengambilan)
    {
        // dd($pengambilan);
        $data = [
            'pengambilan' => $pengambilan->load('kuotaHarian.sa.sppbe', 'truk', 'penyalurans'),
        ];

        // return view('pages/surat-jalan/pdf', $data);

        $pdf = PDF::loadView('pages/surat-jalan/print', $data);

        // return $pdf->download('surat-jalan-'.$pengambilan->id.'.pdf');
        return $pdf->stream('surat-jalan-' . $pengambilan->id . '.pdf');
    }


    public function getNoSA(Request $request)
    {

        $data = [
            'success' => true,
            'data' => KuotaHarian::with('sa.sppbe')->where('tanggal', $request->tanggal)->whereRelation('sa.sppbe', 'sppbe_id', '=', $request->sppbe_id)->get()
        ];

        return response()->json($data);
    }
}
