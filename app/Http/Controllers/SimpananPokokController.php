<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\SimpananPokok;
use PDF;
use App\Anggota;
class SimpananPokokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $simpanan_pokok = SimpananPokok::latest()->get();
        return view('simpanan_pokok.index', compact('simpanan_pokok'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $anggotas = Anggota::where('status', '2')
      ->get();
      return view('simpanan_pokok.create', compact('anggotas'));
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
            'id' => 'required|unique:simpanan_pokok,anggota_id,NULL,id,bulan,'.$request->get('bulan').',tahun,'.$request->get('tahun'),
            'bulan' => 'required',
            'tahun' => 'required',
            'tanggal' => 'required',
            'jumlah' => 'required',
        ]);




        $simpanan = SimpananPokok::firstOrCreate([
            'anggota_id' => $request->get('id'),
            'bulan' => $request->get('bulan'),
            'tahun' => $request->get('tahun'),
        ],

        [
            'tanggal' => $request->get('tanggal'),
            'jumlah' => $request->get('jumlah'),
        ]);


        $simpanan->anggota->nominal_simpanan_pokok = $request->get('jumlah');
        $simpanan->anggota->save();

        return redirect(route('simpanan_pokok.index'));
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
        $simpanan = SimpananPokok::findOrFail($id);
        return view('simpanan_pokok.edit', compact('simpanan'));
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
          'id' => 'required|unique:simpanan_pokok,anggota_id,'.$id.',id,bulan,'.$request->get('bulan').',tahun,'.$request->get('tahun'),
          'bulan' => 'required',
          'tahun' => 'required',
          'tanggal' => 'required',
          'jumlah' => 'required',
      ]);

       $simpanan = SimpananPokok::findOrFail($id);
       $simpanan->update([
        'bulan' => $request->get('bulan'),
        'tahun' => $request->get('tahun'),
        'tanggal' => $request->get('tanggal'),
        'jumlah' => $request->get('jumlah'),
    ]);

       $simpanan->anggota->nominal_simpanan_pokok = $request->get('jumlah');
       $simpanan->anggota->save();

       return redirect(route('simpanan_pokok.index'));
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $simpanan = SimpananPokok::findOrFail($id);
        $simpanan->delete();

        return redirect(route('simpanan_pokok.index'));
        
    }

    public function cetak($id) 
    {
        $simpanan = SimpananPokok::findOrFail($id);


        $pdf = PDF::setPaper('A5','landscape')->loadView('simpanan_pokok.cetak', compact('simpanan'));
        return $pdf->stream();
    }
}
