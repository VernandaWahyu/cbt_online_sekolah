<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use PDF;
//use Maatwebsite\Excel\Facades\Excel;
use Excel;
use App\Imports\SoalImport;
use App\Exports\SoalExport;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Intervention\Image\Facades\Image;
use ZipArchive;
use Illuminate\Support\Facades\File;

class BankSoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.bank_soal.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $data = DB::table('bank_soal')
            ->insert([
                'nama_bank_soal' => $request->nama_bank_soal,
                'deskripsi' => $request->deskripsi,
                'id_guru' => $request->id_guru,
                'passing_grade' => $request->passing_grade,
            ]);

        return response([
            'message' => 'Simpan data berhasil!',
            'data' => $data
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bank_soal = DB::table('bank_soal')->where('id', $id)->first();

        return view('admin.bank_soal.soal', ['bank_soal' => $bank_soal]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $query =  DB::table('bank_soal')
            ->select('bank_soal.*', 'users.name as nama_guru')
            ->join('users', 'users.id', '=', 'bank_soal.id_guru')
            ->where('bank_soal.id', $id)
            ->first();

        return response([
            'message' => 'Edit data berhasil!',
            'data' => $query
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = DB::table('bank_soal')
            ->where('id', $request->id)
            ->update([
                'nama_bank_soal' => $request->nama_bank_soal,
                'deskripsi' => $request->deskripsi,
                'id_guru' => $request->id_guru,
                'passing_grade' => $request->passing_grade,
            ]);

        return response([
            'message' => 'Simpan data berhasil!',
            'data' => $data
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $get_soal = DB::table('soal')->where('id_bank_soal', $id)->first();

        if($get_soal){

            $get_soal_detail = DB::table('soal')->where('id_bank_soal', $id)->get();

            foreach($get_soal_detail as $data){
                $delete_jawaban = DB::table('jawaban')->where('id_soal', $data->id)->delete();
            }

            $detail_soal = DB::table('soal')->where('id_bank_soal', $id)->delete();
            $data = DB::table('bank_soal')->where('id', $id)->delete();
    
            // Menghapus semua file dalam folder media yang mengandung kata dari $id
            $files = glob(public_path('media/*' . $id . '*'));
            foreach ($files as $file) {
                unlink($file);
            }
    
            return response()->json(200);
        }else{
            $data = DB::table('bank_soal')->where('id', $id)->delete();

            return response()->json(200);
        }
        
    }

    public function apiBankSoal()
    {
        $data =  DB::table('bank_soal')
            ->select('bank_soal.*', 'users.name as nama_guru')
            ->join('users', 'users.id', '=', 'bank_soal.id_guru')
            ->orderBy('bank_soal.nama_bank_soal', 'asc')
            ->get();

        return Datatables::of($data)
            ->addColumn('action', function ($data) {

                $button = "
                        <div class=\"row\">
                            <p></p>
                            <button onclick=\"detail($data->id)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Detail Bank Soal\" class=\"btn btn-xs btn-primary rounded-circle\"><i class=\"fa fa-eye\"></i></button>&nbsp;
                            <button onclick=\"edit($data->id)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Ubah Bank Soal\" class=\"btn btn-xs btn-warning rounded-circle\"><i class=\"fa fa-pencil\"></i></button>&nbsp;
                            <button onclick=\"hapus($data->id)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Hapus Bank Soal $data->nama_bank_soal\" class=\"btn btn-xs btn-danger rounded-circle\">
                                <span class=\"fa fa-trash \"></span>
                            </button>
                            </div>
                        ";
                return $button;
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    public function apiBankSoalDetail()
    {

        $data =  DB::table('soal')->where('id_bank_soal', request()->bank_soal_id)
            ->orderBy('id', 'asc');
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {

                $button = "
                        <div class=\"row\">
                            <p></p>
                            <a href=\"/bank_soal/soal/edit?id=$data->id\"  data-toggle=\"tooltip\" data-placement=\"top\" title=\"Ubah Bank Soal\" class=\"btn btn-xs btn-warning rounded-circle\"><i class=\"fa fa-pencil\"></i></a>&nbsp;
                            <button onclick=\"hapus($data->id)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Hapus Bank Soal $data->id\" class=\"btn btn-xs btn-danger rounded-circle\">
                                <span class=\"fa fa-trash \"></span>
                            </button>
                            </div>
                        ";
                return $button;
            })
            ->editColumn('soal', function ($data) {
                return $soal = $data->soal;
            })

            ->rawColumns(['action', 'soal'])
            ->make(true);
    }

    public function listGuru()
    {
        $query =  DB::table('users')->select('*','name as nama_guru')->where('level','guru')->orderBy('name', 'asc')->get();

        return $query;
    }

    public function BankSoalStoreOld(Request $request)
    {
        //dd($request->all());
        // validasi
        
        DB::beginTransaction();
        try {

            $soal = DB::table('soal')->insert([
                'id_bank_soal' => $request->bank_soal_id,
                'soal' => $request->soal
                //'soal' => str_replace("<p>","<p><b>", $request->soal)
            ]);

            $lastInsertedId = DB::table('soal')
                            ->where('id_bank_soal', $request->bank_soal_id)
                            ->select('id')
                            ->orderBy('id', 'desc')
                            ->first()->id;

            $filteredInput = array_filter($request->nilai, function ($value) {
                return $value !== null && $value !== '';
            });
            $filteredJawaban = array_filter($request->jawaban, function ($value) {
                return $value !== null && $value !== '' && $value !== '<p><br></p>';
            });

            $filteredNoJawaban = array_filter($request->no_jawaban, function ($value) {
                return $value !== null && $value !== '';
            });

            foreach ($filteredInput as $no => $nilai) {
                // 
                $jawaban = $filteredJawaban[$no];
                $no_jawaban = $filteredNoJawaban[$no];

                $soal = DB::table('jawaban')->insert([
                    'id_soal' => $lastInsertedId,
                    'jawaban' => $jawaban,
                    'nilai_jawaban' => $nilai,
                    'no_jawaban' => $no_jawaban,
                ]);
            }

            DB::commit();
            return redirect()->route('detail-soal', $request->bank_soal_id)->with('success', 'data berhasil disimpan');
        
        } catch (\Exception $error) {
            DB::rollback();
            return redirect()->route('detail-soal', $request->bank_soal_id)->with('warning', 'gagal menyimpan data');
        }
    }

    public function BankSoalStore(Request $request)
    {
        //dd($request->all());
        // validasi
        
        DB::beginTransaction();
        try {

            $soal = DB::table('soal')->insert([
                'id_bank_soal' => $request->bank_soal_id,
                'soal' => $request->soal
                //'soal' => str_replace("<p>","<p><b>", $request->soal)
            ]);

            $lastInsertedId = DB::table('soal')
                            ->where('id_bank_soal', $request->bank_soal_id)
                            ->select('id')
                            ->orderBy('id', 'desc')
                            ->first()->id;

            //looping untuk simpan jawaban
            $array = [];

            $i = 0;
            foreach($request->nilai as $rowNilai)
            {
                $array[$i]['nilai'] = $rowNilai;
                $i++;
            }

            $i = 0;
            foreach($request->no_jawaban as $rowNoJawaban)
            {
                $array[$i]['no_jawaban'] = $rowNoJawaban;
                $i++;
            }

            $i = 0;
            foreach($request->jawaban as $rowJawaban)
            {
                $array[$i]['jawaban'] = $rowJawaban;
                $i++;
            }

            for($n=0; $n<count($array); $n++){

                // if($array[$n]['nilai'] == 0 && is_null($array[$n]['no_jawaban']) && $array[$n]['jawaban'] == '<p><br></p>'){
                if($array[$n]['nilai'] == 0 && is_null($array[$n]['no_jawaban']) && is_null($array[$n]['jawaban'])){
                    continue; // skip dan lanjut ke iterasi selanjutnya
                }
                
                 $soal = DB::table('jawaban')->insert([
                    'id_soal' => $lastInsertedId,
                    'jawaban' => $array[$n]['jawaban'],
                    'nilai_jawaban' => $array[$n]['nilai'],
                    'no_jawaban' => $array[$n]['no_jawaban'],
                ]);

            }

            DB::commit();
            return redirect()->route('detail-soal', $request->bank_soal_id)->with([
                'success' => 'Data berhasil disimpan!',
                'alert_type' => 'success',
                'alert_size' => 'small',
            ]);
            
        } catch (\Exception $error) {
            DB::rollback();
            return redirect()->route('detail-soal', $request->bank_soal_id)->with('warning', 'gagal menyimpan data');
        }
    }

    public function BankSoalTambah()
    {
        $bank_soal = DB::table('bank_soal')->where('id', request()->bank_soal_id)->first();
        $last = DB::table('soal')->where('id_bank_soal', request()->bank_soal_id)->count();
        $urutan = $last+1;

        return view('admin.bank_soal.soal_tambah', compact('bank_soal','urutan'));
    }

    public function BankSoalEdit(Request $request)
    {
        $soal = DB::table('soal')->where('id', $request->id)->first();
        $jawaban = DB::table('jawaban')->where('id_soal', $soal->id)->get();
        $urutan = DB::table('soal')->where('id', '<=', $soal->id)->where('id_bank_soal', $soal->id_bank_soal)->count();

        return view('admin.bank_soal.soal_edit', compact('soal', 'jawaban','urutan'));
    }

    public function soalDestroy($id)
    {
        $delete_jawaban = DB::table('jawaban')->where('id_soal', $id)->delete();
        $data = DB::table('soal')->where('id', $id)->delete();

        return response()->json(200);
    }

    public function BankSoalUpdate($id, Request $request)
    {
        // validasi
        //dd($request->all());

        DB::beginTransaction();
        try {
            $soal = DB::table('soal')
                ->where('id', $id)
                ->update([
                    'soal' => $request->soal
                ]);
            $bank_soal = DB::table('soal')
                ->where('id', $id)
                ->first();

            $jawaban = DB::table('jawaban')
                ->where('id_soal', $id)->delete();

            $filteredInput = array_filter($request->nilai, function ($value) {
                return $value !== null && $value !== '';
            });
            $filteredJawaban = array_filter($request->jawaban, function ($value) {
                return $value !== null && $value !== '';
            });

            $filteredNoJawaban = array_filter($request->no_jawaban, function ($value) {
                return $value !== null && $value !== '';
            });

            foreach ($filteredInput as $no => $nilai) {
                // 
                $jawaban = $filteredJawaban[$no];
                $no_jawaban = $filteredNoJawaban[$no];

                $soal = DB::table('jawaban')->insert([
                    'id_soal' => $id,
                    'jawaban' => $jawaban,
                    'nilai_jawaban' => $nilai,
                    'no_jawaban' => $no_jawaban,
                ]);
            }

            DB::commit();
            return redirect()->route('detail-soal', $bank_soal->id_bank_soal)->with('success', 'data berhasil disimpan');
        } catch (\Exception $error) {
            DB::rollback();
            return redirect()->route('detail-soal', $bank_soal->id_bank_soal)->with('warning', 'gagal menyimpan data');
        }
    }

    public function uploadImage(Request $request)
    {
        //JIKA ADA DATA YANG DIKIRIMKAN
        if ($request->hasFile('upload')) {
            $file = $request->file('upload'); //SIMPAN SEMENTARA FILENYA KE VARIABLE
            $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); //KITA GET ORIGINAL NAME-NYA
            //KEMUDIAN GENERATE NAMA YANG BARU KOMBINASI NAMA FILE + TIME
            $fileName = $fileName . '_' . time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads'), $fileName); //SIMPAN KE DALAM FOLDER PUBLIC/UPLOADS

            //KEMUDIAN KITA BUAT RESPONSE KE CKEDITOR
            $ckeditor = $request->input('CKEditorFuncNum');
            $url = asset('uploads/' . $fileName);
            $msg = 'Image uploaded successfully';
            //DENGNA MENGIRIMKAN INFORMASI URL FILE DAN MESSAGE
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($ckeditor, '$url', '$msg')</script>";

            //SET HEADERNYA
            @header('Content-type: text/html; charset=utf-8');
            return $response;
        }
    }

    public function BankSoalExport(Request $request, $id)
    {
        $opsi = $request->opsi;

        $soal = DB::table('soal')->where('id_bank_soal', $id)->orderBy('created_at','asc')->get();
        $nama_bank_soal = DB::table('bank_soal')->where('id', $id)->pluck('nama_bank_soal')->first();

        //return view('admin.bank_soal.soal_report', compact('soal'));
        return view('admin.bank_soal.soal_report',['soal' => $soal,'nama_bank_soal' => $nama_bank_soal,'opsi' => $opsi, 'id' => $id]);

        // $pdf = PDF::loadview('admin.bank_soal.soal_report',['soal' => $soal,'nama_bank_soal' => $nama_bank_soal,'opsi' => $opsi]);
        // $pdf->setPaper('A4', 'portrait');
        // return $pdf->stream();
    }

    public function BankSoalPrint($id, $opsi)
    {
        $soal = DB::table('soal')->where('id_bank_soal', $id)->orderBy('created_at','asc')->get();
        $nama_bank_soal = DB::table('bank_soal')->where('id', $id)->pluck('nama_bank_soal')->first();

        $pdf = PDF::loadview('admin.bank_soal.soal_print',['soal' => $soal,'nama_bank_soal' => $nama_bank_soal,'opsi' => $opsi,'id' => $id]);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream();
    }

    public function BankSoalImport($id, Request $request)
    {
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $file->storeAs('words', $filename, 'public');
        $filepath=Storage::disk("public")->path("words/".$filename);
        $wordDoc = \PhpOffice\PhpWord\IOFactory::load($filepath);
        $htmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($wordDoc , 'HTML');
        $htmlWriter->save(public_path('html/example.html'));

        // Read the HTML file and pass it to the view
        $html = file_get_contents(public_path('html/example.html'));
        $splithtml=explode("<p>&nbsp;</p>",$html);
        //$splithtml= $html;
        //dd($splithtml);
        
        $arraySoal=array();
        $arrayJawaban=array();
        $arrayNilaiJawaban=array();
        foreach($splithtml as $htm){
            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($htm);
            libxml_clear_errors();
            $xpath = new \DOMXPath($dom);
            $elements = $xpath->query('//p[contains(@style, "margin-top: 0; margin-bottom: 0;")]');
            $jawaban=array();
            $nilaiJawaban=array();
            $countJawaban=0;
            $countNilaiJawaban=0;
            $soal="";
            foreach ($elements as $element) {
                $hasil = $element->nodeValue;
                if (strpos($hasil, "A") === 0 && is_numeric($hasil[1])) {
                    $jawaban[$countJawaban] = explode(":", $hasil)[1];
                    $countJawaban++;
                
                    // Mengambil gambar jika ada
                    $images = $element->getElementsByTagName("img");
                    if ($images->length > 0) {
                        foreach ($images as $image) {
                            $stringimage = $dom->saveHTML($image);
                            // Masukkan gambar ke dalam array jawaban jika tidak kosong
                            if (!empty($stringimage)) {
                                $jawaban[$countJawaban] = $stringimage;
                                $countJawaban++;
                            }
                        }
                    }

                    // Menghapus nilai kosong dari array jawaban dan menambahkan null jika jumlah elemennya kurang dari 4
                    //$jawaban = array_filter($jawaban);
                    $jawaban = array_filter(array_map('trim', $jawaban));
                    if (count($jawaban) < 4) {
                        $jawaban = array_pad($jawaban, 4, null);
                    }

                    // Mengatur ulang indeks array
                    $jawaban = array_values($jawaban);
                }
                else if(strpos($hasil,"N")===0 && is_numeric($hasil[1])){
                    $nilaiJawaban[$countNilaiJawaban]=explode(":",$hasil)[1];
                    $countNilaiJawaban++;
                }
                else{
                    
                    $images=$element->getElementsByTagName("img");
                    $a="";
                    if($images->length>0){
                        foreach($images as $image){
                            $stringimage=$dom->saveHTML($image);
                                $soal.=$stringimage;
                            } 
                    }
                    else{
                        if(strpos($hasil,":")===2){
                            $hasil=explode(":",$hasil)[1];
                            $soal.=$hasil;
                        }
                        else{
                            $soal.=$hasil;
                        }
                        
                    }
                    
                }
                
                //echo $element->nodeValue . "<br>";
            }
            $arrayJawaban[]=$jawaban;
            $arraySoal[]=$soal;
            $arrayNilaiJawaban[]=$nilaiJawaban;
        }

        // dd($arrayJawaban);

        foreach ($arraySoal as $i => $s) {
            // Cek apakah terdapat tag img
            $containsImgTag = strpos($s, '<img') !== false;

            // Tambahkan tag <p> setelah tag <img> selesai
            if ($containsImgTag) {
                // Temukan posisi akhir dari tag <img>
                $endImgTagPos = strpos($s, '>', strpos($s, '<img')) + 1;

                // Bagi teks menjadi dua bagian, sebelum dan setelah tag <img>
                $beforeImgTag = substr($s, 0, $endImgTagPos);
                $afterImgTag = substr($s, $endImgTagPos);

                // Gabungkan kembali dengan menambahkan tag <p> di antara keduanya
                $soalDenganTagP = $beforeImgTag . '<p>' . $afterImgTag . '</p>';
            } else {
                // Jika tidak ada tag <img>, tambahkan tag <p> seperti biasa
                $soalDenganTagP = '<p>' . $s . '</p>';
            }

            $ids = DB::table('soal')->insertGetId([
                'id_bank_soal' => $id,
                'soal' => $soalDenganTagP,
            ]);

            // Use count($arrayJawaban[$i]) instead of count($arrayJawaban)
            for ($j = 0; $j < count($arrayJawaban[$i]); $j++) {
                // Tambahkan tag <p> </p> pada nilai jawaban
                $jawabanDenganTagP = '<p>' . $arrayJawaban[$i][$j] . '</p>';
            
                DB::table('jawaban')->insert([
                    'id_soal' => $ids,
                    'jawaban' => $jawabanDenganTagP,
                    'nilai_jawaban' => $arrayNilaiJawaban[$i][$j],
                    'no_jawaban' => ($j + 1),
                ]);
            }            
        }


        return redirect()->back()->with('success','Data Imported Successfully');
    }

    public function BankSoalBackupOld($id)
    {
        return Excel::download(new SoalExport, 'soal.csv');
    }

    protected function gen_uid($l=5){
        return substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"), 10, $l);
     }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            
            // Mengompres ukuran file gambar
            $compressedImage = Image::make($file)->encode('jpg', 75); // Menggunakan format JPEG dengan kualitas 75%
            
            // Menentukan nama file dan path untuk penyimpanan
            $id_bank_soal = $request->id_bank_soal;
            $random_string = $this->gen_uid(15);
            $fileName = $id_bank_soal.$random_string.'.jpg';
            $filePath = public_path('media/' . $fileName);
            
            // Simpan file gambar yang sudah dikompres ke direktori penyimpanan
            $compressedImage->save($filePath);
            
            // Mendapatkan URL publik untuk file gambar
            $url = asset('media/' . $fileName);
            
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
        
        return response()->json(['uploaded' => 0]);
    }

    public function BankSoalBackup($id)
    {
        // Mendapatkan data dari tabel soal
        $data = DB::table('soal')
                ->select('soal','jawaban','nilai_jawaban','no_jawaban')
                ->join('jawaban','jawaban.id_soal','=','soal.id')
                ->where('id_bank_soal', $id)
                ->get();
                
        Excel::store(new SoalExport($data), 'excel/soal.xlsx', 'real_public');

        // Nama file zip
        $nama_bank_soal = DB::table('bank_soal')->where('id', $id)->first();
        $zipFilename = 'excel/'.$nama_bank_soal->nama_bank_soal.'.zip';

        // Nama variabel
        $dynamicName = $id;

        // Membuat objek ZipArchive
        $zip = new ZipArchive();

        // Membuka file zip untuk ditulis
        if ($zip->open(public_path($zipFilename), ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
             // Menambahkan file hasil export Excel ke dalam zip
            $zip->addFile(public_path('excel/soal.xlsx'), 'soal.xlsx');

            // Mendapatkan daftar file gambar dari folder media
            $files = glob(public_path('media/*' . $dynamicName . '*'));

            // Menambahkan file gambar ke dalam zip
            foreach ($files as $file) {
                $zip->addFile($file, basename($file));
            }

            // Menutup file zip
            $zip->close();

            // Menghapus file hasil export Excel setelah dimasukkan ke dalam zip
            unlink(public_path('excel/soal.xlsx'));

            // Mengirim respons HTTP dengan file zip yang diunduh
            return response()->download(public_path($zipFilename))->deleteFileAfterSend(true);
        } else {
            // Gagal membuka file zip
            echo 'Gagal membuka file zip.';
        }


    }

    public function BankSoalUpload(Request $request, $extractPath)
    {
        if ($request->hasFile('file')) {
            // Mendapatkan objek UploadedFile dari input file
            $uploadedFile = $request->file('file');

            // Mendapatkan path sementara untuk file zip
            $tempFilePath = $uploadedFile->getRealPath();

            // Membuat objek ZipArchive
            $zip = new ZipArchive();

            // Membuka file zip
            if ($zip->open($tempFilePath) === true) {
                // Ekstrak file gambar ke dalam folder media
                for ($i = 0; $i < $zip->numFiles; $i++) {
                    $filename = $zip->getNameIndex($i);
                    $fileInfo = pathinfo($filename);

                    // Cek apakah file tersebut adalah gambar
                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                    if (in_array(strtolower($fileInfo['extension']), $allowedExtensions)) {
                        $extractedFilePath = $extractPath . '/' . $fileInfo['basename'];
                        $zip->extractTo($extractPath, $filename);
                        
                        // Pindahkan file gambar ke direktori tujuan (folder media)
                        rename($extractPath . '/' . $filename, public_path('media/' . $fileInfo['basename']));
                    } elseif ($fileInfo['extension'] === 'xlsx' || $fileInfo['extension'] === 'xls') {
                        // Menggunakan library phpspreadsheet untuk membaca file Excel
                        $excelFilePath = $extractPath . '/' . $filename;
                        $zip->extractTo($extractPath, $filename);

                        // Mendapatkan data dari kolom "Soal" dalam file Excel
                        $spreadsheet = IOFactory::load($excelFilePath);
                        $worksheet = $spreadsheet->getActiveSheet();
                        $soalData = [];
                        $rowIterator = $worksheet->getRowIterator();
                        $headerRow = $rowIterator->current();
                        $rowIterator->next();

                        foreach ($rowIterator as $row) {
                            $cellIterator = $row->getCellIterator();
                            $cellIterator->setIterateOnlyExistingCells(false);
                            
                            $rowData = [];
                            foreach ($cellIterator as $cell) {
                                $rowData[] = $cell->getValue();
                            }
                        
                            $soalData[] = $rowData;
                        }

                        //dd($soalData);
                        DB::beginTransaction();
                        try{

                            // Filter array berdasarkan nilai atribut 0
                            $filteredArray = array_unique(array_map('serialize', array_column($soalData, 0)));

                            // Mengembalikan array ke format semula
                            $filteredArray = array_map('unserialize', $filteredArray);

                            foreach ($filteredArray as $key => $value) {
                                if ($key === 0) {
                                    continue; // Skip elemen dengan key 0
                                }

                                $id_soal = DB::table('soal')->insertGetId([
                                    'soal' => $value,
                                    'id_bank_soal' => $request->id_bank_soal,
                                ]);
                            }

                            // Memasukkan data ke dalam tabel "jawaban"
                            $loop_soal = DB::table('soal')->where('id_bank_soal', $request->id_bank_soal)->get();

                            //dd($loop_soal);
                            foreach($loop_soal as $raw){

                                foreach (array_slice($soalData, 1) as $data) {

                                    $jawaban = $data[1];
                                    $nilaiJawaban = $data[2];
                                    $noJawaban = $data[3];
        
                                    DB::table('jawaban')->insert([
                                        'id_soal' => $raw->id,
                                        'jawaban' => $jawaban,
                                        'nilai_jawaban' => $nilaiJawaban,
                                        'no_jawaban' => $noJawaban,
                                    ]);
                                }

                            }

                            // Hapus file Excel setelah selesai
                            unlink($excelFilePath);

                            DB::commit();
                            return redirect()->back()->with('success', 'Berhasil melakukan upload soal.');
                        }catch(\Exception $e){
                            DB::rollback();
                            dd($e);
                            return redirect()->back()->with('failed', 'Gagal melakukan upload soal.');
                        }

                    }
                }

                // Menutup file zip
                $zip->close();
            } else {
                // Gagal membuka file zip
                echo 'Gagal membuka file zip.';
            }
        }
    }

}