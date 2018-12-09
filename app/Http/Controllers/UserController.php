<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;

use DB;
use Hash;
use Image;
use File;
class UserController extends Controller
{


    public function daftar_store(Request $request)
    {
     $this->validate($request, [
        'name' => 'required',
        'username' => 'required|unique:users,username',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|same:confirm-password',
    ]);

     $input = $request->all();
     $input['password'] = Hash::make($input['password']);

     $input['status'] = '1';
     $role = 'Panitera';
     $user = User::create($input);
     $user->assignRole($role);
     return response()->json(['success' => true, 'msg' => 'Berhasil']);
 }
 public function daftar() {

    return view('register');
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$data = User::orderBy('id','DESC')->get();
    	return view('users.index',compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = Role::orderBy('id', 'desc')->pluck('name','name')->all();
        return view('users.create',compact('roles'));
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
            'roles' => 'required',
            'status' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')
        ->with('success','User created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$user = User::find($id);
    	return view('users.show',compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$user = User::find($id);
    	return view('users.edit',compact('user'));
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
            'name' => 'required',
            'username' => 'required||unique:users,username,'.$id,
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'foto' => 'sometimes|nullable|max:1500|mimes:jpg,jpeg,png'
        ]);
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));    
        }
        $user = User::findOrFail($id);

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

        }
        
        $user->update($input);

        return back()->with('success','Profile Updated successfully');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        Storage::delete($user->foto);
        Storage::delete($user->foto_small);
        $user->anggota->simpanan_wajib->each(function($i) 
        {
            $i->delete();   
        });
        $user->anggota->simpanan_pokok->each(function($i) 
        {
            $i->delete();   
        });

        $user->anggota->ambil_simpanan->each(function($i) 
        {
            $i->delete();   
        });

        $user->anggota->peminjaman->each(function($i) 
        {
            $i->angsuran->each(function($ii) {
                $ii->delete();  
            });
            $i->delete();
        });

        $user->anggota->delete();
        $user->delete();
        return response()->json(['success' => true, 'msg' => 'Berhasil']);
    }
}