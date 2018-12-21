<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AmbilSimpanan;
use PDF;
use App\Anggota;
class AmbilSimpananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$simpanan = AmbilSimpanan::latest()->get();

        return view('ambil_simpanan.index', compact('simpanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$anggotas = Anggota::with('simpanan_pokok')
    	->where('status', '2')
    	->get();

    	$anggotas->each(function($anggota) {
    		$jumlah_simpanan = $anggota->simpanan_pokok->sum('jumlah');
    		$jumlah_ambil = $anggota->ambil_simpanan->sum('jumlah');

    		$anggota->sisa_simpanan = $jumlah_simpanan - $jumlah_ambil;
    	});

    	return view('ambil_simpanan.create', compact('anggotas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'tanggal' => 'required',
            'jumlah' => 'required|not_in:0',
        ]);
        
        $sisa = $request->get('val_sisa');
        $jumlah = $request->get('jumlah');
        //  if ($jumlah > $sisa) {
        //     $arr = [
        //         'errors' => [
        //             'jumlah' => 
        //             [
        //                 "Jumlah tidak dapat lebih besar dari sisa"
        //             ]
        //         ]
        //     ];
        //     return back()->with($arr, 422);
        // }
        $simpanan = AmbilSimpanan::create([
            'anggota_id' => $request->get('id'),
            'tanggal' => $request->get('tanggal'),
            'jumlah' => $request->get('jumlah'),
        ]);

        return redirect(route('ambil_simpanan.index'));
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
        $ambil = AmbilSimpanan::findOrFail($id);
        $anggota = $ambil->anggota;


        $jumlah_simpanan = $anggota->simpanan_pokok->sum('jumlah');
        $jumlah_ambil = $anggota->ambil_simpanan->sum('jumlah');
        $anggota->sisa_simpanan = ($jumlah_simpanan - $jumlah_ambil) + $ambil->jumlah ;
        return view('ambil_simpanan.edit', compact('ambil'));
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
        $this->validate($request, [
            'tanggal' => 'required',
            'jumlah' => 'required|not_in:0',
        ]);
        
        $simpanan = AmbilSimpanan::findOrFail($id);

        $simpanan->update([
            'tanggal' => $request->get('tanggal'),
            'jumlah' => $request->get('jumlah'),
        ]);

        return redirect(route('ambil_simpanan.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ambil = AmbilSimpanan::findOrFail($id);
        $ambil->delete();

        return redirect(route('ambil_simpanan.index'));
        
    }


    public function cetak($id) 
    {
        $simpanan = AmbilSimpanan::findOrFail($id);

        $anggota = $simpanan->anggota;
        $pokok = $anggota->simpanan_pokok->where("created_at", "<", $simpanan->created_at)->where("tanggal", "<=", $simpanan->tanggal);
        $ambil = $anggota->ambil_simpanan->where("created_at", "<", $simpanan->created_at)->where("tanggal", "<=", $simpanan->tanggal)->where('id', '!=', $simpanan->id);
        $jumlahPokok= $pokok->sum('jumlah');
        $jumlahAmbil= $ambil->sum('jumlah');
        $simpanan->simpanan_pokok = $jumlahPokok - $jumlahAmbil;
        $simpanan->seluruhnya = $simpanan->simpanan_pokok - $simpanan->jumlah;



        $pdf = PDF::setPaper('A5','landscape')->loadView('ambil_simpanan.cetak', compact('simpanan'));
        return $pdf->stream();
    }
}
