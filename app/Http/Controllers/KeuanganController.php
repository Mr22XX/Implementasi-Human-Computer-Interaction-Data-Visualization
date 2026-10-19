<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKeuangan;
use Carbon\Carbon;

class KeuanganController extends Controller
{
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

        return view('dashboardKaryawan.dashboard', compact(
            'labels', 
            'dataPemasukan', 
            'dataPengeluaran', 
            'latestTransactions',
            'availableMonths',
            'tanggalAsli',
            'totalPemasukan',
            'totalPengeluaran',
            'saldo'
        ));

    }

    public function indexKeuangan()
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

        return view('dashboardKaryawan.keuangan', compact(
            'labels', 
            'dataPemasukan', 
            'keuangan', 
            'dataPengeluaran', 
            'latestTransactions',
            'availableMonths',
            'tanggalAsli',
            'totalPemasukan',
            'totalPengeluaran',
            'saldo'
        ));

    }

    public function create()
    {
        return view('dashboardKaryawan.keuangan_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis' => 'required|string',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        \App\Models\DataKeuangan::create($validated);

        return redirect()->route('karyawan.keuangan')->with('success', 'Data keuangan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:255',
        ]);

        // Temukan data berdasarkan ID
        $keuangan = DataKeuangan::findOrFail($id);

        // Update data
        $keuangan->update([
            'tanggal' => $request->tanggal,
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('karyawan.keuangan')
            ->with('success', 'Data keuangan berhasil diperbarui!');
    }

    public function destroy($id)
{
    try {
        // Cari data keuangan berdasarkan ID
        $keuangan = \App\Models\DataKeuangan::findOrFail($id);

        // Hapus data
        $keuangan->delete();

        // Jika request berasal dari AJAX (SweetAlert)
        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        // Jika tidak (redirect biasa)
        return redirect()->back()->with('success', 'Data keuangan berhasil dihapus!');
    } catch (\Exception $e) {
        if (request()->ajax()) {
            return response()->json(['error' => 'Gagal menghapus data.'], 500);
        }

        return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
    }
}


}
