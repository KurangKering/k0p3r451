<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Illuminate\Support\Facades\Storage;
use Hash;
use Image;
use File;
class ProfileController extends Controller
{
	public function __construct()
	{
		
	}
	public function index() {
		$user = \Auth::check() ? \Auth::user() : '';
		return view('profile.index', compact('user'));
	}


	public function update(Request $request,$id)
	{

		$this->validate($request, [
			'name' => 'required',
			'username' => 'required||unique:users,username,'.$id,
			'email' => 'required|email|unique:users,email,'.$id,
			'nip' => 'required:unique:users,nip,'.$id,
			'password' => 'same:confirm-password',
			'tanggal_lahir' => 'required',
			'jenis_kelamin' => 'required',
			'alamat' => 'required',
			'no_telepon' => 'required',
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
}
