<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
        $kategoris = \App\Models\Kategori::all();

         return view("admin.manajemenDataKategori", [
             "title" => "Data Kategori",
             "kategoris" => $kategoris, 
         ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.tambahKategori",
    [
        "title"=> "Tambah Kategori",
        "kategoris"=> Kategori::all(),
    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
   

    public function store(Request $request)
    {
        $validasiData = $request->validate([
            'nama_kategori' => [
                'required','max:255',
               
                Rule::unique('kategoris')->where(function ($query) use ($request) {
                    return $query->where('nama_kategori', $request->nama_kategori)
                                 ->where('peringkat', $request->peringkat);
                }),
            ],
            'peringkat' => 'required|max:255',
            'jumlah_poin'=> 'required|integer',
            ]  , [
            'nama_kategori.unique' => 'Kombinasi kategori dan peringkat ini sudah ada!',
         ]);

        Kategori::create($validasiData);

        return redirect("/manajemenDataKategori")->with("berhasil", "Data kategori berhasil ditambahkan!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return view("admin.UbahKategori",
        [

            "kategori"=> $kategori,
        ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kategori = \App\Models\Kategori::where('id_kategori', $id)->firstOrFail();

        $validasiData = $request->validate([
         'nama_kategori' => [ 'required','max:255',

            Rule::unique('kategoris')->where(function ($query) use ($request) {
                return $query->where('nama_kategori', $request->nama_kategori)
                             ->where('peringkat', $request->peringkat);
            })->ignore($kategori->id_kategori, 'id_kategori'),
        ],
        'peringkat'=> 'required|max:255',
        'jumlah_poin'=> 'required|integer',
    ]);

    $kategori->update($validasiData);

    return redirect("/manajemenDataKategori")->with("berhasil", "Data kategori berhasil diubah!");
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::where('id_kategori', $id)->firstOrFail();
        $kategori->delete();
        return redirect("/manajemenDataKategori")->with("berhasil", "Data kategori berhasil dihapus!");
    }
}
