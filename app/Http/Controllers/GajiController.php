<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GajiKaryawan;
use App\Models\DataKeuangan;
use Carbon\Carbon;

class GajiController extends Controller
{
    public function index()
    {
        // Ambil semua data
        $gaji = GajiKaryawan::orderBy('tanggal', 'asc')->get();

       

        return view('dashboardKaryawan.gaji', compact(
           'gaji'
        ));

    }



    public function create()
    {
        return view('dashboardKaryawan.keuangan_create');
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'nama' => 'required|string',
        'jumlah' => 'required|numeric',
        'tanggal' => 'required|date',
        'keterangan' => 'nullable|string',
    ]);

    // 1. Tambah pengeluaran ke tabel keuangan
    $keuangan = \App\Models\DataKeuangan::create([
        'tanggal'   => $validated['tanggal'],
        'jenis'     => 'pengeluaran',
        'jumlah'    => $validated['jumlah'],
        'keterangan'=> 'Gaji untuk ' . $validated['nama'],
    ]);

    // 2. Tambah ke tabel gaji + simpan id_keuangan
    $gaji = \App\Models\GajiKaryawan::create([
        'nama'       => $validated['nama'],
        'jumlah'     => $validated['jumlah'],
        'tanggal'    => $validated['tanggal'],
        'keterangan' => $validated['keterangan'],
        'id_keuangan'=> $keuangan->id_keuangan,
    ]);

    return redirect()->route('karyawan.gaji')
        ->with('success', 'Data Gaji berhasil ditambahkan!');
}


public function update(Request $request, $id)
{
    $gaji = GajiKaryawan::findOrFail($id);

    $request->validate([
        'nama' => 'required|string',
        'jumlah' => 'required|numeric',
        'tanggal' => 'required|date',
        'keterangan' => 'nullable|string',
    ]);

    // Update tabel gaji
    $gaji->update([
        'nama' => $request->nama,
        'jumlah' => $request->jumlah,
        'tanggal' => $request->tanggal,
        'keterangan' => $request->keterangan,
    ]);

    // Update tabel keuangan yang terkait
    if ($gaji->id_keuangan) {
        DataKeuangan::where('id_keuangan', $gaji->id_keuangan)->update([
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'keterangan' => 'Gaji: '.$request->keterangan,
        ]);
    }

    return redirect()->route('karyawan.gaji')->with('success', 'Data Gaji berhasil diperbarui!');
}



public function destroy($id)
{
    $gaji = GajiKaryawan::findOrFail($id);

    // Hapus data keuangan terkait
    if ($gaji->id_keuangan) {
        DataKeuangan::where('id_keuangan', $gaji->id_keuangan)->delete();
    }

    // Hapus gaji
    $gaji->delete();

    return response()->json(['success' => true]);
}




}
