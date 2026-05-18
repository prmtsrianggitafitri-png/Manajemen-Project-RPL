@extends('layouts.layoutAdmin')

@section('content')
<div class="w-full px-6 py-6 mx-auto font-sans text-slate-700">
    <div class="relative flex flex-col flex-auto min-w-0 p-6 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border max-w-2xl mx-auto">
        
        <div class="pb-4 mb-4 border-b border-gray-100">
            <h5 class="text-xl font-bold bg-gradient-to-tl from-slate-900 to-slate-800 bg-clip-text text-transparent">Ubah Status & Data Mahasiswa</h5>
            <p class="mb-0 text-sm text-slate-400">NIM: {{ $mhs->nim ?? '-' }} | {{ $mhs->email }}</p>
        </div>

        <form action="{{ route('admin.mahasiswa.update', $mhs->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="mb-2 ml-1 text-xs font-bold text-slate-700 uppercase" for="nama">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $mhs->nama) }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-bounce window-blur w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 text-slate-700 transition-all focus:border-blue-300 focus:outline-none focus:transition-shadow" required>
                @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="mb-2 ml-1 text-xs font-bold text-slate-700 uppercase" for="no_telepon">No. Telepon / WA</label>
                <input type="text" name="no_telepon" id="no_telepon" value="{{ old('no_telepon', $mhs->no_telepon) }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-bounce window-blur w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 text-slate-700 transition-all focus:border-blue-300 focus:outline-none focus:transition-shadow">
                @error('no_telepon') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="mb-2 ml-1 text-xs font-bold text-slate-700 uppercase" for="status_mahasiswa">Status Mahasiswa</label>
                <div class="relative">
                    <select name="status_mahasiswa" id="status_mahasiswa" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-bounce window-blur w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 text-slate-700 transition-all focus:border-blue-300 focus:outline-none focus:transition-shadow" required>
                        <option value="aktif" {{ $mhs->status_mahasiswa == 'aktif' ? 'selected' : '' }}>AKTIF</option>
                        <option value="alumni" {{ $mhs->status_mahasiswa == 'alumni' ? 'selected' : '' }}>ALUMNI</option>
                    </select>
                </div>
                @error('status_mahasiswa') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.mahasiswa.index') }}" class="inline-block px-6 py-2.5 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer tracking-tight text-xs ease-bounce bg-clip-padding border-slate-300 text-slate-400 hover:scale-102 active:opacity-85 hover:bg-slate-50">
                    Kembali
                </a>
                <button type="submit" class="inline-block px-6 py-2.5 font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 text-xs ease-bounce bg-gradient-to-tl from-purple-700 to-pink-500 shadow-soft-md tracking-tight">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection