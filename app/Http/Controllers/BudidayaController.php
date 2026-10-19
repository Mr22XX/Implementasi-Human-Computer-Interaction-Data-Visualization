<?php

namespace App\Http\Controllers;

use App\Models\Budidaya;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BudidayaController extends Controller
{
    public function index()
    {
        $budidaya = Budidaya::orderBy('id_budidaya', 'DESC')->get();

        $totalKolam = $budidaya->count();
        $totalBibit = $budidaya->sum('jumlah_bibit');
        $aktif = $budidaya->where('status', 'aktif')->count();

        return view('dashboardKaryawan.budidaya', compact('budidaya', 'totalKolam', 'totalBibit', 'aktif'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kolam' => 'required|string|max:100',
            'jenis_ikan' => 'required|string|max:50',
            'tanggal_tebar' => 'required|date',
            'jumlah_bibit' => 'required|integer',
            'pakan_perhari' => 'required|numeric',
            'perkiraan_panen' => 'nullable|date',
            'status' => 'required|string',
            'keterangan' => 'nullable|string'
        ]);

        $validated['umur_ikan'] = Carbon::parse($request->tanggal_tebar)->diffInDays(Carbon::now());

        Budidaya::create($validated);
        return redirect()->back()->with('success', 'Data budidaya berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $budidaya = Budidaya::findOrFail($id);
        $validated = $request->validate([
            'nama_kolam' => 'required|string|max:100',
            'jenis_ikan' => 'required|string|max:50',
            'tanggal_tebar' => 'required|date',
            'jumlah_bibit' => 'required|integer',
            'pakan_perhari' => 'required|numeric',
            'perkiraan_panen' => 'nullable|date',
            'status' => 'required|string',
            'keterangan' => 'nullable|string'
        ]);

        $validated['umur_ikan'] = Carbon::parse($request->tanggal_tebar)->diffInDays(Carbon::now());

        $budidaya->update($validated);
        return redirect()->back()->with('success', 'Data budidaya berhasil diperbarui.');
    }

  public function destroy($id)
{
    try {
        // Cari data keuangan berdasarkan ID
        $data = Budidaya::findOrFail($id);

        // Hapus data
        $data->delete();

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
