<?php

namespace App\Http\Controllers;

use App\Model\MtBarang;
use App\Model\MtHeadDepartment;
use App\Model\MtPegawai;
use App\Model\TxRent;
use App\Notifications\NotifAcc;
use App\Notifications\NotifPeminjaman;
use App\Notifications\NotifPengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Notification;
use App\User;

class PeminjamanController extends Controller
{
    public function listAdmin(){
        $title = 'List Peminjaman';
        if(Auth::user()->is_admin == true){
            $pinjam = TxRent::with(['barang'])->get();
            return view('pinjam.admin', compact('pinjam', 'title'));
        }else{
            $pinjam = TxRent::with(['barang'])->where('user_id', Auth::user()->id)->get();
            return view('pinjam.user', compact('pinjam','title'));
        }
    }

    public function create(){
        $title = 'Peminjaman Barang';
        $barang = MtBarang::all();
        return view('pinjam.add', compact('barang', 'title'));
    }

    public function store(Request $request){

        $lastKode = TxRent::orderBy('id', 'desc')->first();
        $nextKode = $lastKode ? intval(substr($lastKode->no_pinjam, 9)) + 1 : 1; // Mengambil bagian numerik setelah "INV/0823/"
        $getDate = Carbon::now();
        $yearNow = substr($getDate,2,2);
        $monthNow = date("m",strtotime($getDate));
        $invoiceNumber = 'PJM/' . $monthNow .$yearNow. '/' .str_pad($nextKode, 8, '0', STR_PAD_LEFT);

        try{
            DB::beginTransaction();
            $pinjam = new TxRent();
            $pinjam->no_pinjam = $invoiceNumber;
            $pinjam->tgl_mulai = $request->tgl_mulai;
            $pinjam->tgl_akhir = $request->tgl_akhir;
            $pinjam->barang_id = $request->barang_id;
            $pinjam->jumlah = $request->jumlah;
            $pinjam->user_id = Auth::user()->id;
            $pinjam->save();
            
            DB::commit();

            $emp = MtPegawai::find(Auth::user()->id);
            $head = MtHeadDepartment::find($emp->department_id);
            $HeadDep = MtPegawai::find($head->employee_id);
            $userEmail = User::find($HeadDep->user_id);
            
            $userEmail->notify(new NotifPeminjaman($pinjam));

            // Notification::route('mail', $HeadDep->email)->notify(new NotifPeminjaman($pinjam));

            return redirect(route('pinjam.create'))->with('success', 'Peminjaman Created Successfully');
        }catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return redirect(route('pinjam.create'))->with('toast_error', 'Rent Created Failed Successfully');
        }
    }

    public function acc($id){
        $pinjam = TxRent::with(['user', 'barang'])->find($id);

        try{
            DB::beginTransaction();
            $pinjam->tgl_acc = Carbon::now();
            $pinjam->approve_by = Auth::user()->id;
            $pinjam->save();

            
            $barang = MtBarang::find($pinjam->barang_id);
            $barang->stock = $barang->stock - $pinjam->jumlah;
            $barang->save();
            
            $userEmail = User::find($pinjam->user_id);

            $userEmail->notify(new NotifAcc($pinjam));
            
            DB::commit();

            return redirect(route('list.peminjaman'))->with('success', 'Rent Accept Successfully');
        }catch (\Exception $e) {
            DB::rollback();
            return redirect(route('list.peminjaman'))->with('toast_error', 'Rent End Failed Successfully');
        }
    }

    public function approve($id){
        $pinjam = TxRent::with(['user', 'barang'])->find($id);

        try{
            $pinjam->is_done = true;
            $pinjam->tgl_kembali = Carbon::now();
            $pinjam->save();

            $barang = MtBarang::find($pinjam->barang_id);
            $barang->stock = $barang->stock + $pinjam->jumlah;
            $barang->save();

            $emp = MtPegawai::find($pinjam->user_id);
            $head = MtHeadDepartment::find($emp->department_id);
            $HeadDep = MtPegawai::find($head->employee_id);
            $userEmail = User::find($HeadDep->user_id);

            $userEmail->notify(new NotifPengembalian($pinjam));

            // Notification::route('mail', $HeadDep->email)->notify(new NotifPengembalian($pinjam));

            return redirect(route('list.peminjaman'))->with('success', 'Rent End Successfully');
        }catch (\Exception $e) {
            DB::rollback();
            return redirect(route('list.peminjaman'))->with('toast_error', 'Rent End Failed Successfully');
        }
    }
}
