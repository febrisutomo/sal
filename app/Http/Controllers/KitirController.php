<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kitir;
use App\Models\Sppbe;
use App\Models\KuotaHarian;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

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
    public function index()
    {
        $data = [
            'kitirs' => Kitir::orderBy('bulan_tahun', 'DESC')->get(),
        ];
        return view('pages/kitir/index', $data);
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
        $validated = $request->validate(
            [
                'bulan_tahun' => 'required|unique:kitirs,bulan_tahun',
            ],
            [
                'bulan_tahun.required' => 'Harap masukkan bulan dan tahun.',
                'bulan_tahun.unique' => 'Bulan dan tahun sudah ada.'
            ]
        );

        $kitir = Kitir::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Kitir berhasil dibuat!',
            'data' => $kitir
        ]);
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

        // dd($kitir->load('sas.kuotaHarians', 'sas.sppbe'));
        $data = [
            'kitir' => $kitir->load('sas.kuotaHarians', 'sas.sppbe'),
            'sppbes' => Sppbe::with('sas')->orderBy('nama')->get(),
            'dates' => $this->_calendar($kitir->bulan_tahun),
        ];
        return view('pages/kitir/edit', $data);
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
        //
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
            'message' => 'Kitir berhasil dihapus!'
        ]);
    }

    public function print(Kitir $kitir)
    {

        $data = [
            'kitir' => $kitir->load('sas.kuotaHarians', 'sas.sppbe'),
            'sppbes' => Sppbe::with('sas.kuotaHarians')->whereRelation('sas', 'kitir_id', $kitir->id)->whereHas('sas')->orderBy('nama')->get(),
            'dates' => $this->_calendar($kitir->bulan_tahun),
        ];

        $pdf = PDF::loadView('pages/kitir/print', $data);

        $pdf->setPaper('A4', 'landscape');

        // return $pdf->download('surat-jalan-'.$pengambilan->id.'.pdf');
        return $pdf->stream('kitir-' . date('Y-m', strtotime($kitir->bulanTahun.'-01')) . '.pdf');
    }

    // generate calendar 

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

    private function _calendar($month_year)
    {
        $dates = [];
        $year =  date("Y", strtotime($month_year));
        $month = date("m", strtotime($month_year));

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

        return $dates;
    }
}
