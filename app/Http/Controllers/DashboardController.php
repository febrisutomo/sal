<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Setting;
use App\Models\Penyaluran;
use App\Models\KuotaHarian;
use App\Models\Pengambilan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // dd(Pengambilan::all()->sum('total_penyaluran'));
        $filter = $request->query('filter', 'today');
        
        $request->fullUrlWithQuery(['foo' => 'bar', 'popular']);
        $data = [
            'pengambilans' =>  Pengambilan::when($filter == 'today', function($query){
                $query->whereRelation('kuotaHarian', 'tanggal', Carbon::now()->format('Y-m-d'));
            })->when($filter == 'month', function($query){
                $query->whereHas('kuotaHarian', function($q){
                    $q->whereMonth('tanggal', Carbon::now()->month);
                });
            })->when($filter == 'week', function($query){
                $query->whereHas('kuotaHarian', function($q){
                    $q->whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                });
            })->get(),
            'stok_gudang' => Setting::get()->stok_awal +  Pengambilan::sum('jumlah') - Pengambilan::all()->sum('total_penyaluran'),
            'kuota_harians' => KuotaHarian::with('sa.sppbe')->where('tanggal', date('Y-m-d'))->get()
        ];

        return view('pages.dashboard.index', $data);
    }
}
