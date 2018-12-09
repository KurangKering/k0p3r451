<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Anggota;
use App\AmbilSimpanan;
use Carbon\Carbon;
class LaporanController extends Controller
{


    /**
     * Url generate laporan
     * route('laporan.generate_laporan')
     * url('laporan/generate_laporan')
     * 
     */
    public function generate_laporan(Request $request)
    {
        $jenis_laporan = $request->get('jenis_laporan');
        $bulan = $request->get('bulan');
        $tahun = $request->get('tahun');
        $input_date = Carbon::create($tahun, $bulan)->endOfMonth();
        $inputDate = $input_date->toDateString();
        
        switch ($jenis_laporan) {
            /**
             * Laporan simpanan pokok dan wajib
             */
            case '1':
            $anggotas = Anggota::with(['simpanan_pokok' => function($i) use($bulan, $tahun) {
                $i->where('bulan', '<=', $bulan);
                $i->where('tahun', '<=', $tahun);
            }, 'simpanan_wajib'])
            ->whereYear('tanggal_masuk', '<=', $tahun)
            ->whereMonth('tanggal_masuk', '<=', $bulan)
            ->get();

            $pdf = PDF::setPaper('A4','landscape')->loadView('laporan.laporan_pokok_wajib', compact('anggotas', 'input_date', 'bulan', 'tahun'));
            return $pdf->stream();
            break;


            /**
             *
             * Laporan Ambil Simpanan
             */
            case '2':
            $simpanans = AmbilSimpanan::whereMonth('tanggal', '=', $input_date->month)
            ->whereYear('tanggal', '=', $input_date->year)
            ->get();

            $simpanans->each(function($i) use ($inputDate) {
                $anggota = $i->anggota;
                $pokok = $anggota->simpanan_pokok->where("created_at", "<=", $i->created_at);

                $ambil = $anggota->ambil_simpanan->where("created_at", "<=", $i->created_at)->where('id', '!=', $i->id);
                $jumlahPokok= $pokok->sum('jumlah');
                $jumlahAmbil= $ambil->sum('jumlah');
                $i->simpanan_pokok = $jumlahPokok - $jumlahAmbil;
                $i->seluruhnya = $i->simpanan_pokok - $i->jumlah;
                // echo $i->updated_at;
                // echo $pokok;
                // echo $jumlahPokok;
                // echo $i->simpanan_pokok;
                // echo 'end';
                // echo '<br>';

            });
            $pdf = PDF::setPaper('A4','landscape')->loadView('laporan.laporan_ambil_simpanan', compact('simpanans', 'input_date', 'bulan', 'tahun'));
            return $pdf->stream();
            break;

            default:
        # code...
            break;
        }
        // return view('laporan.laporan_pokok_wajib', compact('anggotas', 'input_date', 'bulan', 'tahun'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis_laporan = [
            '1' => 'Simpanan Pokok dan Wajib',
            '2' => 'Pengambilan Simpanan Pokok',
        ];
        $arrTahun = ['2018'];
        $tahun = array_combine($arrTahun, $arrTahun);
        return view('laporan.index', compact('jenis_laporan', 'tahun'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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