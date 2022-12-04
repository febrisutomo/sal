<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Truk;
use App\Models\Sopir;
use App\Models\Sppbe;
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
    public function index(Request $request)
    {
    //    dd($request->only('no_sa', 'tanggal'));

        // $pengambilans = Pengambilan::with('kuotaHarian.sa', 'truk')->filter($request->only('tanggal', 'no_sa'))->orderBy('id')->get()->sortByDesc(function ($query) {
        //     return $query->kuotaHarian->tanggal;
        // });
        $pengambilans = Pengambilan::with('kuotaHarian.sa', 'truk')->filter($request->only('tanggal', 'no_sa', 'start', 'end'))->latest()->get();

        return view('pages.surat-jalan.index', compact('pengambilans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = [
            'sppbe_id' => $request->sppbe_id,
            'no_sa' => $request->no_sa,
            'pengambilans' => Pengambilan::all(),
            'truks' => Truk::orderBy('kode')->get(),
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
        } catch (Exception $e) {
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
            'pengambilan' => $pengambilan->load('kuotaHarian.sa.sppbe', 'truk.sopir', 'truk.kernet', 'penyalurans', 'penukarans'),
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
            'pengambilans' => Pengambilan::all(),
            'sppbes' => Sppbe::all(),
            'truks' => Truk::orderBy('kode')->get(),
            'sopirs' => Sopir::all(),
            'kernets' => Kernet::all(),
            'pangkalans' => Pangkalan::orderBy('nama')->get(),
            'pengambilan' => $pengambilan->load('kuotaHarian.sa.sppbe', 'truk.sopir', 'truk.kernet', 'penyalurans', 'penukarans')
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

        DB::beginTransaction();

        try {
            $pengambilan->update($validated);



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


            DB::commit();

            return to_route('surat-jalan.show', $pengambilan)->with('success', 'Surat Jalan berhasil diperbarui!');
        } catch (Exception $e) {
            DB::rollBack();

            return to_route('surat-jalan.show', $pengambilan)->with('warning', 'Surat Jalan gagal diperbarui!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengambilan $pengambilan)
    {
        try {
            $pengambilan->delete();
            $messaage = 'Surat Jalan berhasil dihapus';
            $status = 200;
        } catch (Exception $e) {
            $messaage = 'Surat Jalan gagal dihapus!';
            $status = 500;
        }

        return response()->json([
            'message' => $messaage
        ], $status);
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
