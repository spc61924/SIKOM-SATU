<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataBukuExportView;
use App\Imports\ImportDataBukuClass;
use Exception;

class DataBukuController extends Controller
{
    public function index()
    {
        // $data = Buku::latest()->paginate(5); (Menampilkan nilai paling awal)
        // $data = Buku::orderBy('id', 'desc')->paginate(5);
        $data = Buku::orderBy('id', 'desc')->get();
        return view('Buku.index', compact('data'));
    }

    public function create()
    {
        return view('Buku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|min:1|max:100',
            'penulis' => 'required|min:1|max:100',
            'penerbit' => 'required|min:1|max:100',
            'tahun_terbit' => 'required|min:1|numeric',
        ],[
            'judul.required' => 'Judul Wajib Diisi',
            'penulis.required' => 'Penulis Wajib Diisi',
            'penerbit.required' => 'Penerbit Wajib Diisi',
            'tahun_terbit.required' => 'Tahun Terbit Wajib Diisi',
            'tahun_terbit.numeric' => 'Tahun Terbit Wajib Diisi Dalam Angka',
        ]);

        $data = [
            'judul' => $request->input('judul'),
            'penulis' => $request->input('penulis'),
            'penerbit' => $request->input('penerbit'),
            'tahun_terbit' => $request->input('tahun_terbit'),
        ];
        Buku::create($data);
        return redirect('data-buku')->with('success', 'Successfully added data');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Buku::where('id', $id)->first();
        return view('Buku.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|min:1|max:100',
            'penulis' => 'required|min:1|max:100',
            'penerbit' => 'required|min:1|max:100',
            'tahun_terbit' => 'required|min:1|numeric',
        ],[
            'judul.required' => 'Judul Wajib Diisi',
            'penulis.required' => 'Penulis Wajib Diisi',
            'penerbit.required' => 'Penerbit Wajib Diisi',
            'tahun_terbit.required' => 'Tahun Terbit Wajib Diisi',
            'tahun_terbit.numeric' => 'Tahun Terbit Wajib Diisi Dalam Angka',
        ]);

        $data = [
            'judul' => $request->input('judul'),
            'penulis' => $request->input('penulis'),
            'penerbit' => $request->input('penerbit'),
            'tahun_terbit' => $request->input('tahun_terbit'),
        ];

        Buku::where('id', $id)->update($data);
        return redirect('data-buku')->with('success', 'Successfully updated data');
    }

    public function destroy($id)
    {
        Buku::where('id', $id)->delete();
        return redirect('data-buku')->with('success', 'Successfully deleted data');
    }

    public function export_pdf_buku()
    {
         //QUERY
         $data = Buku::select('*');

         $data = $data->get();

         // Pass parameters to the export view
         $pdf = PDF::loadview('Buku.exportPdf', ['data'=>$data]);
         $pdf->setPaper('a4', 'portrait');
         $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
         // SET FILE NAME
         $filename = date('YmdHis') . '_data_buku';
         // Download the Pdf file
         return $pdf->download($filename.'.pdf');
    }

    public function export_excel_buku(Request $request)
    {
        //QUERY
        $data = Buku::select('*');

        $data = $data->get();

        // Pass parameters to the export class
        $export = new DataBukuExportView($data);

        // SET FILE NAME
        $filename = date('YmdHis') . '_data_buku';

        // Download the Excel file
        return Excel::download($export, $filename . '.xlsx');
    }

    public function import_excel_buku(Request $request)
    {
        //DECLARE REQUEST
        $file = $request->file('file');

        //VALIDATION FORM
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        try {
            if($file){
                // IMPORT DATA
                $import = new ImportDataBukuClass;
                Excel::import($import, $file);

                // SUCCESS
                $notimportlist="";
                if ($import->listgagal) {
                    $notimportlist.="<hr> Not Register : <br> {$import->listgagal}";
                }
                return redirect()
                ->route('data-buku')
                ->with('success', 'Import Data berhasil,<br>
                Size '.$file->getSize().', File extention '.$file->extension().',
                Insert '.$import->insert.' data, Update '.$import->edit.' data,
                Failed '.$import->gagal.' data, <br> '.$notimportlist.'');

            } else {
                // ERROR
                return back()
                ->withInput()
                ->with('error','Gagal memproses!');
            }

		}
		catch(Exception $e){
			// ERROR
			return back()
            ->withInput()
            ->with('error','Gagal memproses!');
		}
    }
}
