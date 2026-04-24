@extends('layouts.layoutAdmin')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 m-auto flex-0 lg:w-8/12">
        <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl text-center">
                <h6>Ubah Data Kategori</h6>
            </div>
            <div class="flex-auto p-6">
                <form action="/kategori/{{ $kategori->id_kategori }}" method="POST">
                    @csrf
                    @method('PUT') <div class="flex flex-wrap -mx-3">
                        <div class="w-full max-w-full px-3 mb-4">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Nama Kategori</label>
                            <input type="text" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 outline-none transition-all focus:border-fuchsia-300">
                        </div>

                        <div class="w-full max-w-full px-3 mb-4 lg:w-1/2">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Peringkat</label>
                            <input type="text" name="peringkat" value="{{ old('peringkat', $kategori->peringkat) }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 outline-none transition-all focus:border-fuchsia-300">
                        </div>

                        <div class="w-full max-w-full px-3 mb-4 lg:w-1/2">
                            <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Jumlah Poin</label>
                            <input type="number" name="jumlah_poin" value="{{ old('jumlah_poin', $kategori->jumlah_poin) }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white px-3 py-2 outline-none transition-all focus:border-fuchsia-300">
                        </div>
                    </div>

                    <div class="flex justify-end mt-6">
                        <a href="/manajemenDataKategori" class="inline-block px-6 py-3 mr-3 font-bold text-xs text-slate-400">Batal</a>
                        <button type="submit" class="inline-block px-6 py-3 font-bold text-white uppercase bg-gradient-to-tl from-blue-600 to-cyan-400 rounded-lg text-xs shadow-soft-md">
                            Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection