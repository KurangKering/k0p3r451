<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Anggota;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Facades\Storage;
use Image;
use File;
class AnggotaController extends Controller
{

    public function daftar() {
        return view('register');
    }

    /**
     * Hapus anggota
     * url('anggota/hapus')
     * route('anggota.hapus')
     *
     * 
     */
    public function hapus(Request $request)
    {
        $id = $request->get('id');
        $anggota = Anggota::findOrFail($id);

        Storage::delete($anggota->user->foto);
        Storage::delete($anggota->user->foto_small);

        $anggota->delete();
        $anggota->user->delete();
        
        return response()->json(['msg' => 'Success', 'success' => true]);
    }
    /**
     * Verifikasi anggota diterima atau ditolak
     * value -1 ditolak
     * value 2 diterima
     *
     * route('anggota.verifikasi')
     * url('anggota/verifikasi')
     *
     */
    public function verifikasi(Request $request) {
        $id = request()->get('id');
        $status = request()->get('status');

        $anggota = Anggota::findOrFail($id);

        if ($status == '-1') {
            $anggota->delete();
            $anggota->user->delete();
        } else if ($status == '2') {
            $anggota->status = '2';
            $anggota->tanggal_masuk = now();
            $anggota->save();
        }
        return response()->json(['success' => true, 'msg' => 'Berhasil']);


    }
    /**
     * Daftar anggota yang belum diverifikasi
     * 
     * url('anggota/index_verifikasi')
     * route('anggota.index_verifikasi')
     * 
     */
    public function index_verifikasi()
    {
        $anggotas = Anggota::where('status', '1')->get();

        return view('anggota.index_verifikasi', compact('anggotas'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anggotas = Anggota::where('status', '2')->get();
        return view('anggota.index', compact('anggotas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::orderBy('id', 'desc')->pluck('name','name')->all();
        return view('anggota.create',compact('roles'));
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
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'nip' => 'required|unique:users,nip',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
            'foto' => 'sometimes|nullable|max:1500|mimes:jpg,jpeg,png'
            
        ]);


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole('anggota');

        $anggota = Anggota::create([
            'status' => '1',
            'user_id' => $user->getKey(),
        ]);

        if(!empty($request->file('foto'))){ 

            $photoLama = $user->foto;
            $oldDir  = File::dirName($photoLama);
            $oldName = File::name($photoLama);
            $oldExt  = File::extension($photoLama);
            $delPhotoLama = Storage::delete($photoLama);
            $fullPathOldThumb = "$oldDir/$oldName-small.$oldExt";
            $delOldThumb = Storage::delete($fullPathOldThumb);

            $dirPhoto = 'foto';
            $photoBaru = $request->file('foto');
            $pathPhotoBaru = $photoBaru->store($dirPhoto);
            $filename = File::name($pathPhotoBaru);
            $fileExt = File::extension($pathPhotoBaru);
            $fullPathThumb = storage_path("app/public/$dirPhoto/$filename-small.$fileExt");

            $realPath = $photoBaru->getRealPath();
            $thumbnail = Image::make($realPath)->resize(48,48)->save($fullPathThumb);
            $input['foto'] = $pathPhotoBaru;  
            $user->update($input);

        }


        
        return response()->json(['success' => true, 'msg' => 'Berhasil']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggota.detail', compact('anggota'));
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
