<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\MtDepartment;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Master Department';
        $departments = MtDepartment::all();
        return view('department.index', compact('title', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Department';
        return view('department.add', compact('title'));
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
            $department = new MtDepartment();
            $department->nama = $request->nama;
            $department->lokasi = $request->lokasi;
            $department->save();
            DB::commit();
            return redirect(route('department.index'))->with('success', 'Department Created Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect(route('department.index'))->with('toast_error', 'Department Created Failed Successfully');
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Update Department';
        $department = MtDepartment::find($id);
        return view('department.edit', compact('department', 'title'));
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
        $department = MtDepartment::findOrFail($id);
        try{
            DB::beginTransaction();
            $department->nama = $request->nama;
            $department->lokasi = $request->lokasi;
            $department->save();
            DB::commit();
            return redirect(route('department.index'))->with('success', 'Department Updated Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect(route('department.index'))->with('toast_error', 'Department Updated Failed Successfully');
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
            $department = MtDepartment::findOrFail($id);
            DB::beginTransaction();
            $department->delete();
            DB::commit();
            return redirect(route('department.index'))->with('success', 'Department Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect(route('department.index'))->with('toast_error', 'Department Delete Failed Successfully');
        }
    }
}
