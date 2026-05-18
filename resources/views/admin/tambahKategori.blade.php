@extends('layouts.layoutAdmin')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 m-auto flex-0 lg:w-8/12">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                <div class="flex flex-wrap -mx-3">
                    <div class="flex items-center flex-none w-1/2 max-w-full px-3">
                        <h6 class="mb-0">Tambah Kategori Baru</h6>
                    </div>
                </div>
            </div>
            <div class="flex-auto p-6">
                <form action="/kategori" method="POST" role="form">
                    @csrf
                    
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full max-w-full px-3 mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Nama Kategori</label>
                            <input type="text" name="nama_kategori" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Contoh: Nasional" value="{{ old('nama_kategori') }}" required>
                            @error('nama_kategori')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full max-w-full px-3 mb-4 lg:w-1/2">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Peringkat</label>
                            <input type="text" name="peringkat" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Contoh: Juara 1 / Harapan 1" value="{{ old('peringkat') }}" required>
                            @error('peringkat')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full max-w-full px-3 mb-4 lg:w-1/2">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Jumlah Poin</label>
                            <input type="number" name="jumlah_poin" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-200 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="100" value="{{ old('jumlah_poin') }}" required>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <a href="/manajemenDataKategori" class="inline-block px-6 py-3 mr-3 font-bold text-center uppercase align-middle transition-all bg-transparent border-1 border-solid border-slate-200 rounded-lg cursor-pointer shadow-none leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:opacity-85 text-slate-400">Batal</a>
                        <button type="submit" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer shadow-soft-md bg-x-25 bg-150 leading-pro text-xs ease-soft-in tracking-tight-soft bg-gradient-to-tl from-blue-600 to-cyan-400 hover:scale-102 active:opacity-85">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection