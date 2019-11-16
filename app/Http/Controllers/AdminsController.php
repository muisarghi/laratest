<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Storage;

use App\Admins;
use App\User;
use File;

class AdminsController extends Controller
{
    public function index()
    {
    	$admins = Admins::all();
    	return view('admins', ['admins' => $admins]);
    }
	
	public function add()
	{
		return view('admins_add');
	}

	public function proadd(Request $data)
	{
		$this->validate($data,[
    		'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
    	]);
 
        User::create([
    		'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
    	]);
 
    	return redirect('/admins')->with('message','Data telah masuk');
	}

	public function editadm($id)
	{
		$admins = Admins::find($id);
		return view('admins_edit', ['admins' => $admins]);
	}

	public function update($id, Request $request)
	{
		$this->validate($request,[
		   'name' => 'required',
		   'email' => 'required'
		]);
	 
		$admins = Admins::find($id);
		$admins->name = $request->name;
		$admins->email = $request->email;
		$admins->save();
		return redirect('/admins')->with('message','Data telah diganti');
	}

	public function hapusadm($id)
	{
		$admins = Admins::find($id);
		$admins->delete();
		return redirect('/admins')->with('message','Data telah diganti');
	}
	
	public function forms()
    {
    	return view('forms');
    }
	

	public function addform()
    {
    	return view('addform');
    }

	public function addingform(Request $data)
	{
		$this->validate($data,[
    		'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
			'tgllhr' => ['required', 'string', 'max:50'],
			'telp' => ['required', 'string', 'max:100'],
			'gender' => ['required', 'string', 'max:100'],
            
    	]);
		$now=date('dmYHis');
		$namafile=$data['nama']."-".$now;
		
		
		$foto=$data->file('foto');
		$dest=public_path().'/storage/foto/';
		$namafoto='foto-'.$data->nama.'-'.$now.'.jpg';
		$foto->move($dest,$namafoto);
		
		$contents=$data['nama'].",".$data['email'].",".$data['tgllhr'].",".$data['telp'].",".$data['gender'].",".$namafoto;

		Storage::put('public/'.$data->nama.'-'.$now.'.txt',$contents);
		
		return redirect('/forms')->with('message','Data telah masuk');
	}
	
	public function hapusform($id)
		{
		
		Storage::delete('public/'.$id.'');
		return redirect('/forms')->with('message','Data telah terhapus');
		}
	
	public function editform($id)
		{
		
		
		return view('editform',['id' => $id]);
		}
	
	public function editingform(Request $data)
	{
		$this->validate($data,[ 
            'email' => 'required', 
			'tgllhr' => 'required',
			'telp' => 'required', 
			'gender' => 'required', 
    	]);
		
		
		$id=$data->input('id');
		$foto=$data->file('foto');
		
		$filefotoa=substr($id,0,-3);
		$namafoto='foto-'.$filefotoa.'jpg';
		
		
		if($data->hasFile('foto'))
			{
			$dest=public_path().'/storage/foto/';
			$foto->move($dest,$namafoto);
			}
		else
			{
			}
		
		$contents=$id.",".$data['email'].",".$data['tgllhr'].",".$data['telp'].",".$data['gender'].",".$namafoto;

		
		Storage::put('public/'.$id,$contents);
		

		return redirect('/forms')->with('message','Data telah diganti');
	}
}
