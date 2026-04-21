@extends('layouts.layoutAdmin')

@section('content')
<div class="flex flex-wrap -mx-3">
  <div class="flex-none w-full max-w-full px-3">
    <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
      
      <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <div class="flex flex-wrap -mx-3">
          <div class="flex items-center flex-none w-1/2 max-w-full px-3">
            <h6 class="mb-0">Data Kategori</h6>
          </div>
          <div class="flex-none w-1/2 max-w-full px-3 text-right">
            <a href="/kategori/create" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer shadow-soft-md bg-x-25 bg-150 leading-pro text-xs ease-soft-in tracking-tight-soft bg-gradient-to-tl from-blue-600 to-cyan-400 hover:scale-102 active:opacity-85">
              <i class="fas fa-plus"> </i>&nbsp;&nbsp;Tambah Data
            </a>
          </div>
        </div>
      </div>

      

      <div class="flex-auto px-0 pt-0 pb-2">
        <div class="p-0 overflow-x-auto">

           <!-- alert -->
           @if(session('berhasil'))
              <script>
                  Swal.fire({
                      icon: 'success',
                      title: 'Berhasil!',
                      text: "{{ session('berhasil') }}",
                      showConfirmButton: false,
                      timer: 2000 
                  });
                </script>
            @endif

          <table class="items-center justify-center w-full mb-0 align-top border-gray-200 text-slate-500">
            <thead class="align-bottom">
              <tr>
                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Kategori</th>
                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Peringkat</th>
                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Jumlah Poin</th>
                <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70 text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($kategoris as $k)
              <tr>
                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                  <div class="flex px-2 px-6">
                    <div class="my-auto">
                      <h6 class="mb-0 text-sm leading-normal">{{ $k->nama_kategori }}</h6>
                    </div>
                  </div>
                </td>
                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                  <p class="mb-0 text-sm font-semibold leading-normal">{{ $k->peringkat }}</p>
                </td>
                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                  <span class="text-xs font-semibold leading-tight text-slate-400">{{ $k->jumlah_poin }} Poin</span>
                </td>

                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                     <a href="/kategori/{{ $k->id_kategori }}/edit" class="inline-block px-4 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-pro text-xs ease-soft-in bg-150 tracking-tight-soft bg-x-25 text-slate-400">
                     <i class="fas fa-edit text-info"></i> </a>

                     <form action="/kategori/{{ $k->id_kategori }}" method="POST" id="form-hapus-{{ $k->id_kategori }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="konfirmasiHapus('{{ $k->id_kategori }}', '{{ $k->nama_kategori }}')" class="inline-block px-4 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none leading-pro text-xs ease-soft-in bg-150 tracking-tight-soft bg-x-25 text-slate-400">
                      <i class="fas fa-trash text-danger"></i>
                      </button>
                     </form>
                </td>

              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

<script>
function konfirmasiHapus(id, nama) {
    Swal.fire({
        title: 'Beneran mau hapus?',
        text: "Kategori " + nama + " bakal ilang dari sistem, Lan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#cb0c9f', 
        cancelButtonColor: '#8392ab',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('form-hapus-' + id).submit();
        }
    })
}
</script>