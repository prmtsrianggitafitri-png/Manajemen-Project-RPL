@extends('layouts.layoutAdmin')

@section('content')
<div class="w-full px-6 py-6 mx-auto font-sans text-slate-700">
    
    @if(session('success'))
    <div class="relative w-full p-4 mb-4 text-white rounded-lg bg-gradient-to-tl from-green-600 to-lime-400 shadow-soft-md animate-fade-in text-sm">
        <span class="font-bold">Sukses!</span> {{ session('success') }}
    </div>
    @endif

    <div class="relative flex flex-col flex-auto min-w-0 p-4 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border mb-4">
        <div class="flex flex-wrap flex-row justify-between items-center p-6 px-4 pb-2 bg-white border-b-0 rounded-t-2xl">
            <div>
                <h5 class="text-xl font-bold tracking-tight bg-gradient-to-tl from-slate-900 to-slate-800 bg-clip-text text-transparent">Manajemen Data Mahasiswa</h5>
                <p class="mb-0 text-sm leading-normal text-slate-400">Daftar seluruh mahasiswa Terdaftar di Sistem SIPRESMA</p>
            </div>
        </div>

        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama & NIM</th>
                            <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Kontak / Angkatan</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Gender</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswa as $mhs)
                        <tr>
                            <td class="p-4 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <div class="flex px-2 py-1">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 text-sm font-semibold leading-normal text-slate-800">{{ $mhs->nama }}</h6>
                                        <p class="mb-0 text-xs text-slate-400 leading-tight">NIM: {{ $mhs->nim ?? '-' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="mb-0 text-sm font-semibold leading-normal text-slate-700">{{ $mhs->email }}</p>
                                <p class="mb-0 text-xs text-slate-400 leading-tight">Tahun Masuk: {{ $mhs->tahun_masuk ?? '-' }}</p>
                            </td>
                            <td class="p-4 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <span class="text-xs font-semibold text-slate-600 capitalize">{{ $mhs->jenis_kelamin ?? '-' }}</span>
                            </td>
                            <td class="p-4 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                @if($mhs->status_mahasiswa == 'aktif')
                                <span class="bg-gradient-to-tl from-green-600 to-lime-400 text-white text-xs font-bold px-3 py-1 rounded-md shadow-soft-sm inline-block min-w-[70px] uppercase tracking-wide">Aktif</span>
                                @else
                                <span class="bg-gradient-to-tl from-blue-600 to-cyan-400 text-white text-xs font-bold px-3 py-1 rounded-md shadow-soft-sm inline-block min-w-[70px] uppercase tracking-wide">Alumni</span>
                                @endif
                            </td>
                            <td class="p-4 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.mahasiswa.edit', $mhs->id) }}" class="text-xs font-bold leading-normal text-slate-400 hover:text-blue-500 transition-colors duration-200">
                                        <i class="fas fa-user-edit mr-1"></i> Edit Status
                                    </a>
                                    <span class="text-slate-300">|</span>
                                    <form action="{{ route('admin.mahasiswa.destroy', $mhs->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data mahasiswa ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-xs font-bold leading-normal text-red-500 hover:text-red-700 transition-colors duration-200">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-sm text-slate-400 bg-transparent border-b">
                                Belum ada data mahasiswa terdaftar.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection