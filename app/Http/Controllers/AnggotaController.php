<?php

namespace Perpustakaan\Http\Controllers;

use Perpustakaan\Anggota;
use Illuminate\Http\Request;
use Validator;

class AnggotaController extends Controller
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

        $data = Anggota::orderBy('kelas', 'ASC')->orderBy('nama', 'ASC')->paginate();

        return view('anggota.show')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('anggota.create');
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
          'nama' => 'required',
          'kelas' => 'required',
          'jurusan' => 'required',
          'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
          'alamat' => 'required',
          'telepon' => array('required', 'regex:/[+()|\s|0-9]{10}/'),
        ],[
          'required' => 'Kolom :attribute tidak boleh kosong.',
          'telepon.regex' => 'Kolom telepon harus diisi dengan nomor telepon.',
          'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong.',
        ]);

        if ($validator->fails()) {
            return redirect('anggota/create')
                        ->withErrors($validator)
                        ->withInput();
        } else{
            $requestData = $request->all();
            Anggota::create($requestData);
            return redirect()->to('/anggota')->withStatus('Penambahan Anggota Berhasil!');
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
        $anggota = Anggota::findOrFail($id);

        return view('Anggota.view', compact('anggota'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);

        return view('Anggota.edit', compact('anggota'));
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
        
        $anggota = Anggota::findOrFail($id);
        $anggota->update($requestData);

        return redirect()->to('/anggota')->withStatus('Data Berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Anggota::findOrFail($id)->delete();

        return redirect()->to('/anggota')->withStatus('Anggota Berhasil dihapus!');
    }
}
