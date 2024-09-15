<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.kelas.index');
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

        $data = DB::table('kelas')
                ->insert([
                    'id_program' => $request->id_program,
                    'nama_kelas' => $request->nama_kelas,
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
        $query =  DB::table('kelas')
                ->select('kelas.*','program_bimbel.nama_program')
                ->join('program_bimbel','program_bimbel.id','=','kelas.id_program')
                ->where('kelas.id', $id)
                ->first();
        
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
        $data = DB::table('kelas')
                ->where('id', $request->id)
                ->update([
                    'id_program' => $request->id_program,
                    'nama_kelas' => $request->nama_kelas,
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
        $data = DB::table('kelas')->where('id', $id)->delete();

        return response()->json(200);
    }

    public function apiKelas()
    {
        $data =  DB::table('kelas')
                ->select('kelas.*','program_bimbel.nama_program')
                ->join('program_bimbel','program_bimbel.id','=','kelas.id_program')
                ->orderBy('kelas.nama_kelas','asc')
                ->get();

            return Datatables::of($data)
            ->addColumn('action', function ($data) {

                        $button = "
                        <div class=\"row\">
                            <p></p>
                            <button onclick=\"edit($data->id)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Ubah Kelas\" class=\"btn btn-xs btn-warning rounded-circle\"><i class=\"fa fa-pencil\"></i></button>&nbsp;
                            <button onclick=\"cetak($data->id)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Cetak Siswa\" class=\"btn btn-xs btn-primary rounded-circle\"><i class=\"fa fa-file\"></i></button>&nbsp;
                            <button onclick=\"list_siswa($data->id)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Daftar Siswa\" class=\"btn btn-xs btn-success rounded-circle\"><i class=\"fa fa-users\"></i></button>&nbsp;
                            <button onclick=\"hapus($data->id)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Hapus Kelas $data->nama_program\" class=\"btn btn-xs btn-danger rounded-circle\">
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

    public function listProgram()
    {
        $query =  DB::table('program_bimbel')->orderBy('nama_program','asc')->get();

        return $query;
    }

    public function listProgramKelas(Request $request)
    {
        $id_kelas = $request->input('id_kelas');

        $query =  DB::table('kelas')
                ->select('program_bimbel.nama_program','program_bimbel.id')
                ->join('program_bimbel','program_bimbel.id','=','kelas.id_program')
                ->where('kelas.id', $id_kelas)
                ->orderBy('program_bimbel.nama_program','asc')
                ->get();

        return $query;
    }

    public function listKelas()
    {
        $query =  DB::table('kelas')->orderBy('nama_kelas','asc')->get();

        return $query;
    }

    public function listSiswa($id)
    {
        $kelas = DB::table('kelas')->where('id', $id)->first();

        $siswa = DB::table('users')
                ->where('users.level','siswa')
                ->whereNotIn('users.id', function ($query) use ($id) {
                    $query->select('id_siswa')->where('id_kelas', $id)->from('kelas_siswa');
                })
                ->orderBy('users.name','asc')
                ->get();

        return view('admin.kelas.list_siswa', ['siswa' => $siswa, 'kelas' => $kelas]);
    }    

    public function tambahSiswa($id)
    {
        $kelas = DB::table('kelas')->where('id', $id)->first();

        return view('admin.kelas.tambah_siswa', ['kelas' => $kelas, 'id' => $id]);
    }

    public function getListSiswa(Request $request)
    {
        $id_kelas = $request->id_kelas;

        $result =  DB::table('users')
                    ->select('users.*')
                    ->where('users.level','siswa')
                    ->whereNotIn('users.id', function ($query) use ($id_kelas) {
                        $query->select('id_siswa')->where('id_kelas', $id_kelas)->from('kelas_siswa');
                    })
                    ->orderBy('users.name', 'asc')
                    ->get();

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

    public function apiListSiswa($id)
    {
        $data = DB::table('kelas_siswa')
                ->select('users.*','kelas_siswa.id as id_kelas_siswa')
                ->join('kelas','kelas.id','=','kelas_siswa.id_kelas')
                ->join('users','users.id','=','kelas_siswa.id_siswa')
                ->where('kelas_siswa.id_kelas', $id)
                ->orderBy('users.name','asc')
                ->get();

        return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($data) {

            $button = "
                    <div class=\"row\">
                        <p></p>
                        
                        <button onclick=\"hapus($data->id_kelas_siswa)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Hapus Siswa $data->name\" class=\"btn btn-xs btn-danger\">
                            <span class=\"fa fa-trash \"></span>
                        </button>
                        </div>
                    ";
            return $button;
        })
        ->rawColumns(['action'])
        ->make(true);

    }

    public function simpanListSiswa(Request $request)
    {
        //dd($request->all());

        $id_kelas = $request->id_kelas;

        $array = [];

        $i = 0;
        foreach($request->id_siswa as $rowSiswa)
        {
            $array[$i]['id_kelas'] = $id_kelas;
            $array[$i]['id_siswa'] = $rowSiswa;
            $i++;
        }

        DB::beginTransaction();
        try{

            for($n=0; $n<count($array); $n++){

                $id_ujian_siswa = DB::table('kelas_siswa')
                ->insertGetId([
                    'id_kelas' => $id_kelas,
                    'id_siswa' => $array[$n]['id_siswa'],
                ]);
            }

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
        }

        //return
        return redirect('/kelas/list_siswa/'.$id_kelas);

        // $id_kelas = $request->id_kelas;
        // $id_siswa = $request->id_siswa;

        // $id_kelas_siswa = DB::table('kelas_siswa')
        //     ->insertGetId([
        //         'id_kelas' => $id_kelas,
        //         'id_siswa' => $id_siswa,
        //     ]);

        // return response([
        //     'message' => 'Simpan data berhasil!',
        //     'data' => $id_siswa
        // ],200);
    }

    public function deleteListSiswa($id)
    {
        $data = DB::table('kelas_siswa')->where('id', $id)->delete();   

        return response()->json(200);
    }

    public function cetakSiswa($id)
    {
        $siswa = DB::table('users')
                    ->join('kelas','kelas.id_program','=','users.id_program')
                    ->join('program_bimbel','program_bimbel.id','=','users.id_program')
                    ->join('kelas_siswa','kelas_siswa.id_siswa','=','users.id')
                    ->where('level','siswa')
                    ->where('kelas_siswa.id_kelas', $id)
                    ->get();

        return view('admin.siswa.cetak', compact('siswa'));
    }
}
