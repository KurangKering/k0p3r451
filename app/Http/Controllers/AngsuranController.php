<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Angsuran;
use App\user;
use PDF;
class AngsuranController extends Controller
{

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function index()
      {
        $angsuran = Angsuran::latest()->get();
        return view('angsuran.index', compact('angsuran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anggotas = User::role('anggota')
        ->with('simpanan_pokok')
        ->where('status', '2')
        ->get();

        $anggotas->each(function($anggota) {
            $jumlah_simpanan = $anggota->simpanan_pokok->sum('jumlah');
            $jumlah_ambil = $anggota->ambil_simpanan->sum('jumlah');

            $anggota->sisa_simpanan = $jumlah_simpanan - $jumlah_ambil;
        });

        return view('angsuran.create', compact('anggotas'));
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
            'status' => 'required',
        ]);
        
        $angsuran = Angsuran::create([
            'peminjaman_id' => $request->get('id'),
            'tanggal' => $request->get('tanggal'),
            'jumlah' => $request->get('jumlah'),
            'periode_ke' => $request->get('periode_ke'),
        ]);

        $angsuran->peminjaman->status = $request->get('status');
        $angsuran->peminjaman->save();

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
        $angsuran = Angsuran::findOrFail($id);
        $pinjam = $angsuran->peminjaman;
        $pinjam->sisa_angsuran = ($pinjam->jumlah - $pinjam->angsuran->sum('jumlah')) + $angsuran->jumlah;

        return view('angsuran.edit', compact('angsuran'));
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
        'status' => 'required',
    ]);

      $angsuran = Angsuran::findOrFail($id);
      $angsuran->update([
        'tanggal' => $request->get('tanggal'),
        'jumlah' => $request->get('jumlah'),
    ]);

      $angsuran->peminjaman->status = $request->get('status');
      $angsuran->peminjaman->save();

      return redirect(route('angsuran.index'));
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $angsuran = Angsuran::findOrFail($id);
        $angsuran->delete();

        $angsuran->peminjaman->status = '1';
        $angsuran->peminjaman->save();
        return redirect(route('angsuran.index'));
        
    }

    public function cetak($id) 
    {
        $angsuran = Angsuran::findOrFail($id);


        $pdf = PDF::setPaper('A5','landscape')->loadView('angsuran.cetak', compact('angsuran'));
        return $pdf->stream();
    }

}
