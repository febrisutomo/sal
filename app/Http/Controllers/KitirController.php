<?php

namespace App\Http\Controllers;

use App\Models\Sa;
use Carbon\Carbon;
use App\Models\Kitir;
use App\Models\Sppbe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KitirController extends Controller
{

    private $currentDay = 0;
    private $currentMonth = 0;
    private $currentYear = 0;
    private $daysInMonth = 0;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $bulan = $request->bulan ?? date("Y-m");

        $dates = [];

        $year =  date("Y", strtotime($bulan));
        $month = date("m", strtotime($bulan));

        $this->currentYear = $year;

        $this->currentMonth = $month;

        $this->daysInMonth = $this->_daysInMonth($month, $year);

        $weeksInMonth = $this->_weeksInMonth($month, $year);
        // Create weeks in a month
        for ($i = 0; $i < $weeksInMonth; $i++) {

            //Create days in a week
            for ($j = 0; $j < 7; $j++) {
                $dates[$i][$j] = $this->_showDay($i * 7 + $j);
            }
        }

        $data = [
            'bulan' => $bulan,
            'sppbes' => Sppbe::with('sas')->orderBy('nama')->get(),
            'sas' => Sa::with('sppbe', 'kitirs')->whereYear('bulan_tahun', Carbon::create($bulan)->year)
                ->whereMonth('bulan_tahun', Carbon::create($bulan)->month)->get(),
            'kitirs' => Kitir::with('sa.sppbe')->whereYear('tanggal', Carbon::create($bulan)->year)
                ->whereMonth('tanggal', Carbon::create($bulan)->month)->get(),
            'dates' => $dates,
        ];

        // dd($data['sas']);


        // dd($data['kitirs']->where('tanggal', $date.'-01')->where('sa.sppbe_id', 1));
        return view('pages/kitir/create', $data);
    }

    private function _showDay($cellNumber)
    {

        if ($this->currentDay == 0) {

            $firstDayOfTheWeek = date('N', strtotime($this->currentYear . '-' . $this->currentMonth . '-01'));

            if (intval($cellNumber) == intval($firstDayOfTheWeek)) {

                $this->currentDay = 1;
            }
        }

        if (($this->currentDay != 0) && ($this->currentDay <= $this->daysInMonth)) {

            $this->currentDate = date('Y-m-d', strtotime($this->currentYear . '-' . $this->currentMonth . '-' . ($this->currentDay)));

            $cellContent = $this->currentDay;

            $this->currentDay++;
        } else {

            $this->currentDate = null;

            $cellContent = null;
        }


        return $cellContent;
    }

    private function _weeksInMonth($month = null, $year = null)
    {

        if (null == ($year)) {
            $year =  date("Y", time());
        }

        if (null == ($month)) {
            $month = date("m", time());
        }

        // find number of days in this month
        $daysInMonths = $this->_daysInMonth($month, $year);

        $numOfweeks = ($daysInMonths % 7 == 0 ? 0 : 1) + intval($daysInMonths / 7);

        $monthEndingDay = date('N', strtotime($year . '-' . $month . '-' . $daysInMonths));

        $monthStartDay = date('N', strtotime($year . '-' . $month . '-01'));

        if ($monthEndingDay < $monthStartDay) {

            $numOfweeks++;
        }

        return $numOfweeks;
    }

    private function _daysInMonth($month = null, $year = null)
    {

        if (null == ($year))
            $year =  date("Y", time());

        if (null == ($month))
            $month = date("m", time());

        return date('t', strtotime($year . '-' . $month . '-01'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'sppbes' => Sppbe::orderBy('nama')->get(),
            'kitirs' => Kitir::with('sa.sppbe')->orderBy('tanggal')->get(),

        ];
        // dd($data);
        return view('pages/kitir/create', $data);
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
            'tanggal' => 'required',
            'sa_id' => 'required',
            'kuota' => 'required',
        ]);

        $validated['sisa_kuota'] = $validated['kuota'];
        Kitir::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kuota berhasil ditambahkan!',
        ]);

        // dd($request->data);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kitir  $kitir
     * @return \Illuminate\Http\Response
     */
    public function show(Kitir $kitir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kitir  $kitir
     * @return \Illuminate\Http\Response
     */
    public function edit(Kitir $kitir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kitir  $kitir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kitir $kitir)
    {
        $request->validate([
            'kuota' => 'required',
        ]);

        $kitir->update(['kuota' => $request->kuota]);

        return response()->json([
            'success' => true,
            'message' => 'Kuota berhasil diubah!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kitir  $kitir
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kitir $kitir)
    {
        $kitir->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kuota berhasil dihapus!'
        ]);
    }

    public function getSA(Request $request)
    {

        $data = Sa::with('sppbe')->whereYear('bulan_tahun', $request->tahun)
            ->whereMonth('bulan_tahun', $request->bulan)
            ->where('sppbe_id', $request->sppbe_id)->get();
        // dd($data);
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
}
