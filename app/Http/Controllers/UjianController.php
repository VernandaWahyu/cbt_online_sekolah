<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use Auth;
use Excel;
use App\Exports\UjianHasilExport;
use Illuminate\Support\Str;

class UjianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.ujian.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        //$cek_kategori = DB::table('kategori_ujian')->where('id', $request->id_kategori)->first();

        $jadwal_mulai = date('Y-m-d', strtotime($request->jadwal_mulai)).' '.$request->waktu_mulai;
        $jadwal_selesai = date('Y-m-d', strtotime($request->jadwal_selesai)).' '.$request->waktu_selesai;

        $data = DB::table('ujian')
                ->insert([
                    //'id_kategori' => $request->id_kategori,
                    'nama_ujian' => $request->nama_ujian,
                    'nama_pembuat' => Auth::user()->name,
                    //'urutan_soal' => $cek_kategori->urutan_soal,
                    //'urutan_jawaban' => $cek_kategori->urutan_jawaban,
                    'jadwal_mulai' => $jadwal_mulai,
                    'jadwal_selesai' => $jadwal_selesai,
                    'durasi_min' => $request->durasi_min,
                    'durasi_max' => $request->durasi_max,
                ]);

        return response([
            'message' => 'Simpan data berhasil!',
            'data' => $data
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ujian = DB::table('ujian')->where('id', $id)->first();

        return view('admin.ujian.detail', ['id' => $id, 'ujian' => $ujian]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $query =  DB::table('ujian')
                ->select('ujian.*')
                ->where('ujian.id', $id)
                ->first();

        $jadwal_mulai = $query->jadwal_mulai;
        $jadwal_selesai = $query->jadwal_selesai;

        $query->jadwal_mulai = date('d-m-Y', strtotime($jadwal_mulai));
        $query->jadwal_selesai = date('d-m-Y', strtotime($jadwal_selesai));
        $query->waktu_mulai = date('H:i', strtotime($jadwal_mulai));
        $query->waktu_selesai = date('H:i', strtotime($jadwal_selesai));

        return response([
            'message' => 'Edit data berhasil!',
            'data' => $query
        ],200);
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
        //$cek_kategori = DB::table('kategori_ujian')->where('id', $request->id_kategori)->first();

        $jadwal_mulai = date('Y-m-d', strtotime($request->jadwal_mulai)).' '.$request->waktu_mulai;
        $jadwal_selesai = date('Y-m-d', strtotime($request->jadwal_selesai)).' '.$request->waktu_selesai;

        $data = DB::table('ujian')
                ->where('id', $request->id)
                ->update([
                    //'id_kategori' => $request->id_kategori,
                    'nama_ujian' => $request->nama_ujian,
                    'nama_pembuat' => Auth::user()->name,
                    // 'urutan_soal' => $cek_kategori->urutan_soal,
                    // 'urutan_jawaban' => $cek_kategori->urutan_jawaban,
                    'jadwal_mulai' => $jadwal_mulai,
                    'jadwal_selesai' => $jadwal_selesai,
                    'durasi_min' => $request->durasi_min,
                    'durasi_max' => $request->durasi_max,
                ]);

        return response([
            'message' => 'Simpan data berhasil!',
            'data' => $data
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ujian_soal = DB::table('ujian_soal')->where('id_ujian', $id)->delete();
        $ujian = DB::table('ujian')->where('id', $id)->delete();
        $hapus_jawaban = DB::table('jawaban_ujian_siswa')
                        ->where('id_ujian', $id)
                        ->delete();

        $ujian_siswa = DB::table('ujian_siswa')->where('id_ujian', $id)->delete();

        return response()->json(200);
    }

    public function hapusSoal($id)
    {
        $data = DB::table('ujian_soal')->where('id', $id)->delete();

        return response()->json(200);
    }

    public function deleteListSiswa($id)
    {
        $get_ujian = DB::table('ujian_siswa')->where('id', $id)->first();
        $hapus_jawaban = DB::table('jawaban_ujian_siswa')
                        ->where('id_ujian', $get_ujian->id_ujian)
                        ->where('id_siswa', $get_ujian->id_siswa)
                        ->delete();

        $data = DB::table('ujian_siswa')->where('id', $id)->delete();

        return response()->json(200);
    }

    public function apiUjian()
    {
        $data =  DB::table('ujian')
                ->select('ujian.*')
                ->orderBy('ujian.nama_ujian','asc')
                ->get();

            return Datatables::of($data)
            ->addColumn('action', function ($data) {

                        $button = "
                        <div class=\"row\">
                            <p></p>
                            <button onclick=\"detail($data->id)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Detail Ujian\" class=\"btn btn-xs btn-primary rounded-circle\"><i class=\"fa fa-eye\"></i></button>&nbsp;
                            <button onclick=\"edit($data->id)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Ubah Ujian\" class=\"btn btn-xs btn-warning rounded-circle\"><i class=\"fa fa-pencil\"></i></button>&nbsp;
                            <button onclick=\"list_siswa($data->id)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Daftar Peserta Ujian\" class=\"btn btn-xs btn-success rounded-circle\"><i class=\"fa fa-users\"></i></button>&nbsp;
                            <button onclick=\"hapus($data->id)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Hapus Ujian $data->nama_ujian\" class=\"btn btn-xs btn-danger rounded-circle\">
                                <span class=\"fa fa-trash \"></span>
                            </button>
                            </div>
                        ";
                        return $button;


            })
            ->editColumn('jadwal_mulai', function($data){
                return date('d-m-Y H:i',strtotime($data->jadwal_mulai));
            })
            ->editColumn('jadwal_selesai', function($data){
                return date('d-m-Y H:i',strtotime($data->jadwal_selesai));
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    public function apiUjianSoal()
    {
        $data =  DB::table('ujian_soal')
                    ->select('soal.*','ujian_soal.id as id_soal')
                    ->join('soal','soal.id','=','ujian_soal.id_soal')
                    ->where('ujian_soal.id_ujian', request()->id_ujian)
                    ->orderBy('ujian_soal.id', 'asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {

                $button = "
                        <div class=\"row\">
                            <p></p>

                            <button onclick=\"hapus($data->id_soal)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Hapus Ujian Soal $data->id_soal\" class=\"btn btn-xs btn-danger\">
                                <span class=\"fa fa-trash \"></span>
                            </button>
                            </div>
                        ";
                return $button;
            })
            ->editColumn('soal', function ($data) {
                return $data->soal;
                //return Str::limit($data->soal, 200);
            })

            ->rawColumns(['action', 'soal'])
            ->make(true);
    }

    public function apiListSiswa($id)
    {
        $data = DB::table('ujian_siswa')
            ->select('ujian_siswa.*', 'users.name as nama_siswa', 'users.id as id_siswa', 'kelas.nama_kelas')
            ->join('users', 'users.id', '=', 'ujian_siswa.id_siswa')
            ->join('kelas_siswa', 'kelas_siswa.id_siswa', '=', 'users.id')
            ->join('kelas', 'kelas.id', '=', 'kelas_siswa.id_kelas')
            ->where('ujian_siswa.id_ujian', $id)
            ->orderBy('users.name', 'asc')
            ->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {

                $button = "
                        <div class=\"row\">
                            <p></p>
                            <button onclick=\"show_nilai($data->id)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Lihat Hasil Ujian $data->nama_siswa\" class=\"btn btn-xs btn-success\">
                                <span class=\"fa fa-file-text \"></span>
                            </button>
                            &nbsp;
                            <button onclick=\"hapus($data->id)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Hapus Ujian Soal $data->nama_siswa\" class=\"btn btn-xs btn-danger\">
                                <span class=\"fa fa-trash \"></span>
                            </button>

                            </div>
                        ";
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function tambahSoal($id)
    {
        $ujian = DB::table('ujian')->where('id', $id)->first();
        $bank_soal = DB::table('bank_soal')->orderBy('nama_bank_soal','asc')->get();

        return view('admin.ujian.tambah', ['id' => $id, 'ujian' => $ujian, 'bank_soal' => $bank_soal]);
    }

    public function detailSoal($id)
    {
        $soal = DB::table('soal')->where('id', $id)->first();

        return view('admin.ujian.detail_soal', ['id' => $id, 'soal' => $soal]);
    }

    public function listKategoriUjian()
    {
        $query =  DB::table('kategori_ujian')->orderBy('nama_kategori','asc')->get();

        return $query;
    }

    public function getListSoal(Request $request)
    {
        $id_ujian = $request->id_ujian;
        $acak = $request->acak;
    
        if ($acak == 'ya') {
            $result = DB::table('soal')
                ->select('soal.*', 'bank_soal.nama_bank_soal')
                ->where('id_bank_soal', $request->bank_soal)
                ->join('bank_soal', 'bank_soal.id', '=', 'soal.id_bank_soal')
                ->whereNotIn('soal.id', function ($query) use ($id_ujian) {
                    $query->select('id_soal')->where('id_ujian', $id_ujian)->from('ujian_soal');
                })
                ->get()
                ->toArray();
    
            // Algoritma Fither Yates Yang Di Gunakan Untuk Mengacak Soal
            $n = count($result);
            for ($i = $n - 1; $i > 0; $i--) {
                $j = rand(0, $i);
                $temp = $result[$i];
                $result[$i] = $result[$j];
                $result[$j] = $temp;
            }
    
        } else {
            $result = DB::table('soal')
                ->select('soal.*', 'bank_soal.nama_bank_soal')
                ->join('bank_soal', 'bank_soal.id', '=', 'soal.id_bank_soal')
                ->where('id_bank_soal', $request->bank_soal)
                ->orderBy('soal.id', 'asc')
                ->whereNotIn('soal.id', function ($query) use ($id_ujian) {
                    $query->select('id_soal')->where('id_ujian', $id_ujian)->from('ujian_soal');
                })
                ->get();
        }
    
        foreach ($result as $data) {
            $hasil_string = strip_tags($data->soal);
            $data->soal = mb_substr($hasil_string, 0, 100, 'UTF-8'); // Menggunakan mb_substr untuk memastikan pemotongan dalam format UTF-8
        }
    
        $ran = array('#fffcb3', '#e6fffe', '#fac8c0', 'f2e1f5', '#fffcb3', '#e6fffe', '#fac8c0', 'f2e1f5');
        $warna = $ran[array_rand($ran, 1)];
    
        $arr_id = [];
    
        $row = '';
        // $no = $lanjutan+1;
        foreach ($result as $key => $raw_data) {
            array_push($arr_id, $raw_data->id);
    
            $row .= "<tr id='tr_" . $raw_data->id . "'>";
    
            $row .= "<input type='hidden' value='" . $raw_data->id . "' name='id_soal[]' id='soal_id_" . $raw_data->id . "'>";
    
            $row .= "<td style='text-align:center'><input type='checkbox'></td>";
    
            $row .= "<td> <input style='background-color: " . $warna . ";' type='text' class='form-control input-sm' readonly value='" . $raw_data->nama_bank_soal . "' ></td>";
    
            $row .= "<td> <input type='text' class='form-control input-sm' readonly value='" . $raw_data->soal . "' ></td>";
    
            $row .= "<td> <button type='button' value='" . $raw_data->id . "' class='btn btn-danger btn-sm btn-delete' onclick='hapusBaris(" . $raw_data->id . ")'><span class='fa fa-trash'></span></button></td>";
    
            $row .= "</tr>";
        }
    
        // $row = $result;
        $data = [
            'arr_id' => $arr_id,
            'data_row' => $row,
        ];
    
        return $data;
    }
    
    public function simpanSoal(Request $request)
    {
        //dd($request->all());

        $array = [];

        $i = 0;
        foreach($request->id_soal as $rowSoal)
        {
            $array[$i]['id_ujian'] = $request->id_ujian;
            $array[$i]['id_soal'] = $rowSoal;
            $i++;
        }


        DB::beginTransaction();
        try{

            for($n=0; $n<count($array); $n++){
            	DB::table('ujian_soal')
                ->insert([
                    'id_ujian' => $request->id_ujian,
                    'id_soal' => $array[$n]['id_soal'],
                    'tipe_acak' => $request->tipe_acak,
                    //'urutan' => $array[$n]['urutan'],
                ]);
            }

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
        }

        $id = $request->id_ujian;
        $ujian = DB::table('ujian')->where('id', $request->id_ujian)->first();

        return redirect()->route('admin.ujian.detail', ['id' => $id, 'ujian' => $ujian]);
    }

    public function listSiswa($id)
    {
        $ujian = DB::table('ujian')->where('id', $id)->first();
        $kelas = DB::table('kelas')->orderBy('nama_kelas','asc')->get();
        $count_soal = DB::table('ujian_soal')->where('id_ujian', $id)->count();

        return view('admin.ujian.list_siswa', ['ujian' => $ujian,'kelas' => $kelas,'count_soal' => $count_soal]);
    }

    public function kelasListSiswa($id)
    {
        //$query =  DB::table('users')->where('id_program', $id)->orderBy('name','asc')->get();

        $query = DB::table('kelas_siswa')
                ->select('users.name','users.id')
                ->join('kelas','kelas.id','=','kelas_siswa.id_kelas')
                ->join('users','users.id','=','kelas_siswa.id_siswa')
                ->where('kelas_siswa.id_kelas', $id)
                ->orderBy('users.name','asc')
                ->get();

        return $query;
    }

    public function tambahListSiswa($id)
    {
        $ujian = DB::table('ujian')->where('id', $id)->first();
        $bank_soal = DB::table('bank_soal')->orderBy('nama_bank_soal','asc')->get();

        $kelas =  DB::table('kelas')
                            ->select('kelas.*')
                            ->join('kelas_siswa','kelas_siswa.id_kelas','=','kelas.id')
                            ->orderBy('kelas.nama_kelas','asc')
                            ->distinct()
                            ->get();

        return view('admin.ujian.tambah_list_siswa', ['id' => $id, 'ujian' => $ujian, 'bank_soal' => $bank_soal, 'kelas' => $kelas]);
    }

    public function getListSiswa(Request $request)
    {
        $id_ujian = $request->id_ujian;

        $query = DB::table('users')
            ->select('users.*', 'kelas.nama_kelas','kelas.id as id_kelas')
            ->join('kelas_siswa', 'kelas_siswa.id_siswa', '=', 'users.id')
            ->join('kelas', 'kelas.id', '=', 'kelas_siswa.id_kelas')
            ->where('users.level', 'siswa')
            ->whereNotIn('users.id', function ($query) use ($id_ujian) {
                $query->select('id_siswa')->where('id_ujian', $id_ujian)->from('ujian_siswa');
            })
            ->orderBy('users.name', 'asc');

        if ($request->kelas) {
            $query->where('kelas_siswa.id_kelas', $request->kelas);
        }

        $result = $query->get();

        foreach ($result as $key => $raw_data) {
            $raw_data->nama_kelas = $raw_data->nama_kelas;

            if ($request->kelas != $raw_data->id_kelas) {
                unset($result[$key]);
            }
        }


        $ran = array('#fffcb3','#e6fffe','#fac8c0','f2e1f5','#fffcb3','#e6fffe','#fac8c0','f2e1f5');
        $warna = $ran[array_rand($ran, 1)];

        $arr_id = [];

        $row = '';
        // $no = $lanjutan+1;
        foreach ($result as $key => $raw_data) {
            array_push($arr_id, $raw_data->id);

            $row .= "<tr id='tr_".$raw_data->id."'>";

            $row .= "<input type='hidden' value='". $raw_data->id ."' name='id_siswa[".$key."]' id='siswa_id_". $raw_data->id."'>";

            $row .= "<td style='text-align:center'><input type='checkbox'></td>";

            $row .= "<td> <input type='text' class='form-control input-sm' readonly value='".$raw_data->name."' ></td>";

            $row .= "<td> <input style='background-color: ".$warna.";' type='text' class='form-control input-sm' readonly value='".$raw_data->nama_kelas."' ></td>";

            $row .= "<td> <button type='button' value='".$raw_data->id."' class='btn btn-danger btn-sm btn-delete' onclick='hapusBaris(". $raw_data->id.")'><span class='fa fa-trash'></span></button></td>";

            $row .= "</tr>";
        }


        // $row = $result;
        $data = [
            'arr_id' => $arr_id,
            'data_row' => $row,
        ];

        return $data;
    }

    public function simpanListSiswa(Request $request)
    {
        //dd($request->all());

        //logic simpan peserta ujian
        $id_ujian = $request->id_ujian;

        $array = [];

        $i = 0;
        foreach($request->id_siswa as $rowSiswa)
        {
            $array[$i]['id_ujian'] = $id_ujian;
            $array[$i]['id_siswa'] = $rowSiswa;
            $i++;
        }

        DB::beginTransaction();
        try{

            for($n=0; $n<count($array); $n++){

                $id_ujian_siswa = DB::table('ujian_siswa')
                ->insertGetId([
                    'id_ujian' => $id_ujian,
                    'id_siswa' => $array[$n]['id_siswa'],
                    'nilai' => 0,
                    'flag' => 'false'
                ]);

                $id_siswa = $array[$n]['id_siswa'];

                //cek tipe acak atau tidaknya
                $cek_tipe = DB::table('ujian_soal')->where('id_ujian', $id_ujian)->first();

                //create log ujian siswa
                if($cek_tipe->tipe_acak == 'ya'){
                    $get_soal = DB::table('ujian_soal')->where('id_ujian', $id_ujian)->inRandomOrder()->get();
                }else{
                    $get_soal = DB::table('ujian_soal')->where('id_ujian', $id_ujian)->orderBy('id','asc')->get();
                }

                //dd($get_soal);

                //->chunk(100, function ($get_soal) use ($id_siswa, $id_ujian, $id_ujian_siswa) {

                $no = 1;
                foreach ($get_soal as $data) {

                    //get bank soal
                    $bank_soal = DB::table('soal')
                                    ->select('bank_soal.id','bank_soal.nama_bank_soal')
                                    ->join('bank_soal','bank_soal.id','=','soal.id_bank_soal')
                                    ->where('soal.id', $data->id_soal)
                                    ->first();

                    $data = DB::table('jawaban_ujian_siswa')
                        ->insert([
                            'id_ujian' => $id_ujian,
                            'id_siswa' => $id_siswa,
                            'id_soal' => $data->id_soal,
                            'id_ujian_siswa' => $id_ujian_siswa,
                            'id_jawaban' => 0,
                            'nilai_jawaban' => 0,
                            'id_bank_soal' => $bank_soal->id,
                            'nama_bank_soal' => $bank_soal->nama_bank_soal,
                            'nomor' => $no++
                        ]);
                }

            }

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
        }

        //return
        return redirect('/ujian/list_siswa/'.$id_ujian);
    }

    public function exportHasilSiswa($id)
    {

        $data =  DB::table('ujian_siswa')
                    ->select('ujian_siswa.*','users.name as nama_siswa','kelas.nama_kelas')
                    ->join('users','users.id','=','ujian_siswa.id_siswa')
                    ->join('kelas','kelas.id_program','=','users.id_program')
                    ->where('ujian_siswa.id_ujian', $id)
                    ->orderBy('users.name', 'asc')
                    ->get();

        $export = new UjianHasilExport($data);
        return Excel::download($export, 'Hasil Ujian Siswa'.'.xlsx');

    }

    public function showNilai($id)
    {
        $ujian = DB::table('ujian_siswa')->where('id', $id)->first();

        $data = DB::table('jawaban_ujian_siswa')
                ->select('nama_bank_soal', 'id_siswa', 'id_ujian', DB::raw('SUM(nilai_jawaban) AS total_nilai'))
                ->where('id_siswa', $ujian->id_siswa)
                ->where('id_ujian', $ujian->id_ujian)
                ->groupBy('nama_bank_soal', 'id_siswa','id_ujian')
                ->get();

        return $data;

    }
}
