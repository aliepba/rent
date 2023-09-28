<?php

namespace App\Http\Controllers;

use App\Model\MtDepartment;
use App\Model\MtHeadDepartment;
use App\Model\MtPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HeadDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Master Department';
        $head = MtHeadDepartment::with(['department', 'employee'])->get();

        return view('head.index', compact('title', 'head'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Head Department';
        $departments = MtDepartment::all();
        $employees = MtPegawai::all();

        return view('head.add', compact('title', 'departments', 'employees'));
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
            $head = new MtHeadDepartment();
            $head->department_id = $request->department_id;
            $head->employee_id = $request->employee_id;
            $head->save();
            DB::commit();
            return redirect(route('head-department.index'))->with('success', 'Head Department Created Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect(route('head-department.index'))->with('toast_error', 'Head Department Created Failed Successfully');
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
        $title = 'Edit Head Department';
        $departments = MtDepartment::all();
        $employees = MtPegawai::all();
        $head = MtHeadDepartment::find($id);

        return view('head.edit', compact('title', 'departments', 'employees', 'head'));
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
        $head = MtHeadDepartment::find($id);

        try{
            DB::beginTransaction();
            $head->department_id = $request->department_id;
            $head->employee_id = $request->employee_id;
            $head->save();
            DB::commit();
            return redirect(route('head-department.index'))->with('success', 'Head Department Updated Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect(route('head-department.index'))->with('toast_error', 'Head Department Updated Failed Successfully');
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
            $head = MtHeadDepartment::find($id);
            DB::beginTransaction();
            $head->delete();
            DB::commit();
            return redirect(route('head-department.index'))->with('success', 'Department Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect(route('head-department.index'))->with('toast_error ', 'Department Delete Failed Successfully');
        }
    }
}
