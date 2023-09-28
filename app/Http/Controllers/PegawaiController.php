<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\MtPegawai;
use App\Model\MtDepartment;
use Illuminate\Support\Facades\Hash;
use App\User;
use Notification;
use App\Notifications\NotifUser;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'List Pegawai';
        $employees= MtPegawai::all();

        return view('employee.index', compact('title', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Pegawai';
        $department = MtDepartment::all();

        return view('employee.add', compact('title', 'department'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
 
            $password = $this->generateRandomString(8);
            $user = new User();
            $user->name = $request->nama;
            $user->email = $request->email;
            $user->password = Hash::make($password);
            $user->before_pass = $password;
            $user->save();

            $emp = new MtPegawai();
            $emp->nik = $request->nik;
            $emp->nama = $request->nama;
            $emp->alamat = $request->alamat;
            $emp->tanggal_lahir = $request->tgl_lahir;
            $emp->kelamin = $request->kelamin;
            $emp->kontak = $request->kontak;
            $emp->email = $request->email;
            $emp->department_id = $request->department_id;
            $emp->photo = $request->hasFile('photo') ?  $request->file('photo')->store('file/photo', 'public') : 'file/nofile.pdf';
            $emp->user_id = $user->id;
            $emp->save();
            DB::commit();

            $user->notify(new NotifUser($user->email, $password));

            // Notification::route('mail', $request->email)->notify(new NotifUser($request->email, $password));

            return redirect(route('pegawai.index'))->with('success', 'Employee Created Successfully');
        }catch (\Exception $e) {
            DB::rollback();
            return redirect(route('pegawai.index'))->with('toast_error', 'Employee Created Failed Successfully');
        }
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
        $title = 'Edit Pegawai';
        $department = MtDepartment::all();
        $data = MtPegawai::find($id);
        return view('employee.edit', compact('title', 'department', 'data'));
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
        try{
            DB::beginTransaction();
            $emp = MtPegawai::find($id);
 
            $user = User::find($emp->user_id);
            $user->name = $request->nama;
            $user->email = $request->email;
            $user->save();

            $emp->nik = $request->nik;
            $emp->nama = $request->nama;
            $emp->alamat = $request->alamat;
            $emp->tanggal_lahir = $request->tgl_lahir;
            $emp->kelamin = $request->kelamin;
            $emp->kontak = $request->kontak;
            $emp->email = $request->email;
            $emp->department_id = $request->department_id;
            $emp->photo = $request->hasFile('photo') ?  $request->file('photo')->store('file/photo', 'public') : $emp->photo;
            $emp->save();
            DB::commit();

            return redirect(route('pegawai.index'))->with('success', 'Employee Updated Successfully');
        }catch (\Exception $e) {
            DB::rollback();
            return redirect(route('pegawai.index'))->with('toast_error', 'Employee Updated Failed Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $emp = MtPegawai::findOrFail($id);
            DB::beginTransaction();
            $user = User::find($emp->user_id);
            $user->delete();
            $emp->delete();
            DB::commit();
            return redirect(route('pegawai.index'))->with('success', 'Employee Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect(route('pegawai.index'))->with('toast_error ', 'Employee Delete Failed Successfully');
        }
    }

    function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
