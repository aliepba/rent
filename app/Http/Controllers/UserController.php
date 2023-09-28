<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'List Users';
        $users = User::all();

        return view('users.index', compact('title', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah User';

        return view('users.add', compact('title'));
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
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->before_pass = $request->password;
            $user->is_admin = true;
            $user->save();
            DB::commit();
            return redirect(route('users.index'))->with('success', 'User Created Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect(route('users.index'))->with('toast_error', 'User Created Failed Successfully');
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
        $title = 'Edit User';
        $user = User::find($id);
        return view('users.edit', compact('title', 'user'));
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
        $user = User::find($id);
        try{
            DB::beginTransaction();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->before_pass = $request->password;
            $user->save();
            DB::commit();
            return redirect(route('users.index'))->with('success', 'User Update Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect(route('users.index'))->with('toast_error', 'User Update Failed Successfully');
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
        $user = User::find($id);
        try{
            DB::beginTransaction();
            $user->delete();
            DB::commit();
            return redirect(route('users.index'))->with('success', 'User Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect(route('users.index'))->with('toast_error', 'User Deleted Failed Successfully');
        }
    }
}
