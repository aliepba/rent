<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\MtBarang;

class MtBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Master Barang';
        $barang= MtBarang::all();

        return view('barang.index', compact('title', 'barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Master Barang';
        
        return view('barang.add', compact('title'));
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
            $barang = new MtBarang();
            $barang->kode = $request->kode;
            $barang->nama = $request->nama;
            $barang->stock = $request->stock;
            $barang->img = $request->hasFile('img') ?  $request->file('img')->store('file/img-barang', 'public') : 'file/nofile.pdf';;
            $barang->save();
            DB::commit();
            return redirect(route('barang.index'))->with('success', 'Item Created Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect(route('barang.index'))->with('toast_error', 'Item Created Failed Successfully');
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
        $title = 'Edit Barang';

        $barang = MtBarang::find($id);

        return view('barang.edit', compact('title', 'barang'));
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
        $barang = MtBarang::find($id);
        try{
            DB::beginTransaction();
            $barang->kode = $request->kode;
            $barang->nama = $request->nama;
            $barang->stock = $request->stock;
            $barang->img = $request->hasFile('img') ?  $request->file('img')->store('file/img-barang', 'public') : $barang->img ;
            $barang->save();
            DB::commit();
            return redirect(route('barang.index'))->with('success', 'Item Updated Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect(route('barang.index'))->with('toast_error', 'Item Updated Failed Successfully');
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
        $barang = MtBarang::find($id);
        try{
            DB::beginTransaction();
            $barang->delete();
            DB::commit();
            return redirect(route('barang.index'))->with('success', 'Item Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect(route('barang.index'))->with('toast_error', 'Item Deleted Failed Successfully');
        }
    }
}
