<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = Buku::all();
        return view('data_buku.index',compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data_buku.form_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate(
            [
                'judul' => 'required',
                'penulis' => 'required',
                'penerbit' => 'required',
                'tahun_terbit' => 'required|max:4',
            ],
            [
                'judul.required' => 'judul wajib diisi',
                'penulis.required' => 'penulis wajib diisi',
                'penerbit.required' => 'penerbit wajib diisi',
                'tahun_terbit.required' => 'tahun terbit wajib diisi',
            ],
        );

        $data = [
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
        ];

        Buku::create($data);
        return redirect()->route('buku.index')->with('success','Data Berhasil di Simpan');
    }
   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buku = Buku::findorfail($id);
        return view('data-buku.formEdit', compact('buku'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = Buku::findorfail($id);

        $buku->delete();

        return redirect()->route('data-buku')->with('success', 'Data berhasil dihapus');
    }

    public function export_pdf()
{
    $data = Buku::orderBy('judul', 'asc')->get();

    // Pass parameters to the export view
    $pdf = PDF::loadView('data_buku.exportpdf', ['data' => $data]);
    $pdf->setPaper('a4', 'portrait');
    $pdf->setOption(['dpi' => '150', 'defaultFont' => 'sans-serif']);
    
    // Define file name
    $filename = date('YmdHis') . 'data_buku.pdf';

    // Download the PDF
    return $pdf->download($filename);
}
public function export_excel()
{
    $data = Buku::select('*')->get();

    $export = new DataBukuExportView($data);

    $filename = date('YmdHIs') . '_data_buku';
    return Excel::download($export, $filename . '.xlsx');
}

}
