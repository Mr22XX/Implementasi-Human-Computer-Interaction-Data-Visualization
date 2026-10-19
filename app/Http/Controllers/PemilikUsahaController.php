<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKeuangan;
use App\Models\Budidaya;
use Carbon\Carbon;



class PemilikUsahaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // Ambil semua data
        $keuangan = DataKeuangan::orderBy('tanggal', 'asc')->get();

        // Label tanggal (format d M)
        $labels = $keuangan->pluck('tanggal')->map(fn($date) => Carbon::parse($date)->format('d M'));

        // Data pemasukan & pengeluaran (pastikan lowercase sesuai seeder)
        $dataPemasukan = $keuangan->where('jenis', 'pemasukan')->pluck('jumlah')->values();
        $dataPengeluaran = $keuangan->where('jenis', 'pengeluaran')->pluck('jumlah')->values();

        // Ambil 5 data terbaru untuk tabel
        $latestTransactions = DataKeuangan::orderBy('tanggal', 'desc')->take(5)->get();

       // Total Pemasukan
        $totalPemasukan = DataKeuangan::where('jenis', 'Pemasukan')->sum('jumlah');

        // Total Pengeluaran
        $totalPengeluaran = DataKeuangan::where('jenis', 'Pengeluaran')->sum('jumlah');

        // Hitung saldo
        $saldo = $totalPemasukan - $totalPengeluaran;


       // Dapatkan daftar bulan yang tersedia dari data
        $availableMonths = DataKeuangan::selectRaw('DATE_FORMAT(tanggal, "%Y-%m") as bulan')
            ->groupBy('bulan')
            ->orderBy('bulan', 'desc')
            ->pluck('bulan');

        // Kirim tanggal asli untuk filter
        $tanggalAsli = $keuangan->pluck('tanggal');

        $budidaya = Budidaya::orderBy('id_budidaya', 'DESC')->get();

        $totalKolam = $budidaya->count();
        $totalBibit = $budidaya->sum('jumlah_bibit');
        $aktif = $budidaya->where('status', 'aktif')->count();

        $dataBibit = $budidaya->pluck('jumlah_bibit')->values();
        $dataIkan = $budidaya->pluck('jumlah_ikan')->sum();

         return view('dashboardPemilik.dashboard', compact(
            'labels', 
            'dataPemasukan', 
            'dataPengeluaran', 
            'latestTransactions',
            'availableMonths',
            'tanggalAsli',
            'totalPemasukan',
            'totalPengeluaran',
            'saldo',
            'budidaya', 'totalKolam', 'totalBibit', 'aktif',
            'dataBibit',
            'dataIkan'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
