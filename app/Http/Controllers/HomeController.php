<?php

namespace App\Http\Controllers;

use App\Model\MtBarang;
use App\Model\TxRent;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('IsAdmin')->only('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = 'Dashboard';
        $jumlahBarang = MtBarang::count();
        $jumlahPinjam = TxRent::where('is_done', false)->count();
        $jumlahPinjamSelesai = TxRent::where('is_done', true)->count();
        return view('home', compact('title', 'jumlahBarang', 'jumlahPinjam', 'jumlahPinjamSelesai'));
    }

    public function dashboardUser(){
        $title = 'Dashboard';
        return view('welcome', compact('title'));
    }
}
