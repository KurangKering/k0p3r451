<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peminjaman;
use App\Anggota;
use PDF;
class PeminjamanController extends Controller
{


    public function angsur($id) 
    {
        $pinjam = Peminjaman::findOrFail($id);
        
        $pinjam->sisa_angsuran = $pinjam->jumlah - $pinjam->angsuran->sum('jumlah');
        return view('peminjaman.angsur', compact('pinjam'));
    }
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function index()
      {
        $pinjaman = Peminjaman::get();
        $pinjaman->each(function($pinjam) {
            $jumlah_angsuran = $pinjam->angsuran->sum('jumlah');

            $pinjam->sisa_angsuran = $pinjam->jumlah - $jumlah_angsuran;

        });
        return view('peminjaman.index', compact('pinjaman'));
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

        return view('peminjaman.create', compact('anggotas'));
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
            'jumlah' => 'required',
            'periode' => 'required',
        ]);
        
        $simpanan = Peminjaman::create([
            'anggota_id' => $request->get('id'),
            'tanggal' => $request->get('tanggal'),
            'jumlah' => $request->get('jumlah'),
            'periode' => $request->get('periode'),
        ]);

        return redirect(route('peminjaman.index'));
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
        $ambil = Peminjaman::findOrFail($id);
        $anggota = $ambil->anggota;


        $jumlah_simpanan = $anggota->simpanan_pokok->sum('jumlah');
        $jumlah_ambil = $anggota->ambil_simpanan->sum('jumlah');
        $anggota->sisa_simpanan = ($jumlah_simpanan - $jumlah_ambil) + $ambil->jumlah ;

        return view('peminjaman.edit', compact('ambil'));
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
            'jumlah' => 'required',
            'periode' => 'required',
            'status' => 'required',
        ]);

        $simpanan = Peminjaman::findOrFail($id);
        $simpanan->update([
            'tanggal' => $request->get('tanggal'),
            'jumlah' => $request->get('jumlah'),
            'periode' => $request->get('periode'),
            'status' => $request->get('status'),
        ]);

        return redirect(route('peminjaman.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ambil = Peminjaman::findOrFail($id);
        $ambil->delete();

        return redirect(route('peminjaman.index'));
        
    }

    public function cetak($id) 
    {
        $peminjaman = Peminjaman::findOrFail($id);


        $pdf = PDF::setPaper('A5','landscape')->loadView('peminjaman.cetak', compact('peminjaman'));
        return $pdf->stream();
    }
}
