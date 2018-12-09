<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SimpananWajib;
use App\Anggota;
use PDF;
class SimpananWajibController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $simpanan_wajib = SimpananWajib::latest()->get();
        return view('simpanan_wajib.index', compact('simpanan_wajib'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anggotas = Anggota::whereDoesntHave('simpanan_wajib')
        ->where('status', '2')
        ->get();
        return view('simpanan_wajib.create', compact('anggotas'));
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
            'id' => 'required|unique:simpanan_wajib,anggota_id',
            'tanggal' => 'required',
            'jumlah' => 'required',
        ]);


        $simpanan = SimpananWajib::create([
            'anggota_id' => $request->get('id'),
            'tanggal' => $request->get('tanggal'),
            'jumlah' => $request->get('jumlah'),
        ]);

        return redirect(route('simpanan_wajib.index'));
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
        $simpanan = SimpananWajib::findOrFail($id);
        return view('simpanan_wajib.edit', compact('simpanan'));
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
            'id' => 'required|unique:simpanan_wajib,anggota_id,'.$id,
            'tanggal' => 'required',
            'jumlah' => 'required',
        ]);


        $simpanan = SimpananWajib::findOrFail($id)->update([
            'tanggal' => $request->get('tanggal'),
            'jumlah' => $request->get('jumlah'),
        ]);

        return redirect(route('simpanan_wajib.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $simpanan_wajib = SimpananWajib::findOrFail($id);
        $simpanan_wajib->delete();

        return response()->json(['success' => true]);
    }

    public function cetak($id) 
    {
        $simpanan = SimpananWajib::findOrFail($id);

        // return view('simpanan_wajib.cetak', compact('simpanan'));

        $pdf = PDF::setPaper('A5','landscape')->loadView('simpanan_wajib.cetak', compact('simpanan'));
        return $pdf->stream();
    }
}
