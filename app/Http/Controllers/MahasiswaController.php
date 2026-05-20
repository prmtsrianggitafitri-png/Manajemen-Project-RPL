<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = User::where('role', 'mahasiswa')->orderBy('nama', 'asc')->get();

        return view('admin.dataMahasiswa', compact('mahasiswa'));
    }

    public function edit($id)
    {
        $mhs = User::where('role', 'mahasiswa')->findOrFail($id);

        return view('admin.editdataMahasiswa', compact('mhs'));
    }

    public function update(Request $request, $id)
    {
        $mhs = User::where('role', 'mahasiswa')->findOrFail($id);

        $request->validate([
            'status_mahasiswa' => 'required|in:aktif,alumni',
            'nama' => 'required|string|max:255',
            'no_telepon' => 'nullable|string|max:15',
        ]);

        $mhs->update([
            'nama' => $request->nama,
            'no_telepon' => $request->no_telepon,
            'status_mahasiswa' => $request->status_mahasiswa,
        ]);

        return redirect('/dataMahasiswa')->with('success', 'Data dan Status Mahasiswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $mhs = User::where('role', 'mahasiswa')->findOrFail($id);
        $mhs->delete();

        return redirect('/dataMahasiswa')->with('success', 'Data mahasiswa berhasil dihapus dari sistem.');
    }
}