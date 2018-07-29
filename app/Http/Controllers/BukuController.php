<?php

namespace Perpustakaan\Http\Controllers;

use Perpustakaan\Buku;
use Illuminate\Http\Request;
use Validator;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct ()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $data = Buku::all();

        return view('buku.show')->with('data', $data);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'judul' => 'required',
          'pengarang' => 'required',
          'penerbit' => 'required',
          'tahun' => 'required|numeric|digits:4',
          'halaman' => 'required|numeric',
          'kategori' => 'required',
          'stok' => 'required|numeric',
          'rak' => 'required',
        ], [
            'required' => 'Kolom :attribute tidak boleh kosong.',
            'tahun.numeric' => 'Kolom tahun harus diisi dengan angka',
            'tahun.digits' => 'Kolom tahun harus diisi dengan 4 angka',
            'halaman.required' => 'Kolom halaman harus diisi dengan angka',
            'stok.required' => 'Kolom stok harus diisi dengan angka',
        ]);

        if ($validator->fails()) {
            return redirect('buku/create')
                        ->withErrors($validator)
                        ->withInput();
        } else{
            $requestData = $request->all();
            Buku::create($requestData);
            return redirect()->to('/buku')->withStatus('Penambahan Buku Berhasil!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $buku = Buku::findOrFail($id);

        return view('buku.view', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);

        return view('buku.edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        
        $buku = Buku::findOrFail($id);
        $buku->update($requestData);

        return redirect()->to('/buku')->withStatus('Data Berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Buku::findOrFail($id)->delete();

        return redirect()->to('/buku')->withStatus('Buku Berhasil dihapus!');
    }
}
