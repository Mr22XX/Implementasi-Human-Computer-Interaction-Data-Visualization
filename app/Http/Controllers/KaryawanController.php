<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
public function index() {
    $users = User::all();
    return view('dashboardKaryawan.karyawan', compact('users'));
}

public function store(Request $r) {
    User::create([
        'role' => $r->role,
        'name' => $r->name,
        'username' => $r->username,
        'email' => $r->email,
        'alamat' => $r->alamat,
        'password' => bcrypt('password123')
    ]);

    return redirect()->back();
}

public function update(Request $r, $id) {
    User::find($id)->update([
        'role' => $r->role,
        'name' => $r->name,
        'username' => $r->username,
        // 'email' => $r->email,
        'alamat' => $r->alamat,
    ]);

    return redirect()->back();
}

public function destroy($id) {
    User::find($id)->delete();
}

}