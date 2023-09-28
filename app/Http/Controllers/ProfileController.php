<?php

namespace App\Http\Controllers;

use App\Model\MtDepartment;
use App\Model\MtPegawai;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index(){
        $title = 'Profile Pegawai';
        $data = MtPegawai::where('user_id', Auth::user()->id)->first();
        $department = MtDepartment::all();
        return view('profile.index', compact('title', 'data', 'department'));
    }

    public function update(Request $request, $id){
        $data = MtPegawai::findOrFail($id);

        try{
            $data->nik = $request->nik;
            $data->nama = $request->nama;
            $data->alamat = $request->alamat;
            $data->tanggal_lahir = $request->tgl_lahir;
            $data->kelamin = $request->kelamin;
            $data->kontak = $request->kontak;
            $data->email = $request->email;
            $data->save();

            $user = User::find(Auth::user()->id);
            $user->email = $request->email;
            $user->before_pass = $request->password != null ? $request->password : $user->before_pass;
            $user->password = $request->password != null ?  Hash::make($request->password) : $user->password;
            $user->save();

            return redirect(route('profile.index'))->with('success', 'Employee Updated Successfully');
        }catch (\Exception $e) {
            DB::rollback();
            return redirect(route('profile.index'))->with('toast_error', 'Employee Updated Failed');
        }
    }
}
