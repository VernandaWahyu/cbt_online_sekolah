<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Excel;
use App\Imports\SiswaImport;
use Illuminate\Support\Facades\File;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data =  DB::table('users')
        // ->select('users.*','program_bimbel.nama_program')
        // ->join('program_bimbel','program_bimbel.id','=','users.id_program')
        // ->where('users.level','siswa')
        // ->orderBy('users.name','asc')
        // ->get();

        return view('admin.siswa.index');
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

        //coding upload image baru
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $extension = $image->getClientOriginalExtension();
            $fileName = 'avatar'.time() . '.' . $extension;
            
            $path = public_path('avatar/' . $fileName); // Ubah folder penyimpanan menjadi "avatar"
    
            // Pindahkan file avatar ke folder "avatar"
            $image->move(public_path('avatar'), $fileName);
        }

        $data = DB::table('users')
                ->insertGetId([
                    'id_program' => $request->id_program,
                    'name' => $request->nama_siswa,
                    'no_siswa' => $request->no_siswa,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' =>  date('Y-m-d', strtotime($request->tanggal_lahir)),
                    //'username' => $request->username,
                    'email' => $request->email,
                    //'password' => bcrypt($request->password),
                    'level' => 'siswa',
                    'avatar' => $fileName,
                    'status' => 'tidak aktif'
                ]);

        $kelas_siswa = DB::table('kelas_siswa')
                    ->insert([
                        'id_siswa' => $data,
                        'id_kelas' => $request->id_kelas,
                    ]);

        return response()->json([
			'status' => 200,
		]);
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
        $query =  DB::table('users')
                ->select('users.*','program_bimbel.nama_program','kelas.id as id_kelas')
                ->join('program_bimbel','program_bimbel.id','=','users.id_program')
                ->join('kelas','kelas.id_program','=','program_bimbel.id')
                ->where('users.id', $id)
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
        // Dapatkan data pengguna yang akan diupdate
        $user = DB::table('users')
                    ->where('id', $request->id)
                    ->first();

        // Inisialisasi variabel fileName dengan avatar yang sudah ada
        $fileName = $user->avatar;

        // Lakukan penggantian foto profil jika ada file yang diunggah
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $extension = $image->getClientOriginalExtension();
            $fileName = 'avatar'.time() . '.' . $extension;
            
            $path = public_path('avatar/' . $fileName);

            // Pindahkan file avatar ke folder "avatar"
            $image->move(public_path('avatar'), $fileName);

            // Hapus avatar lama jika ada (opsional)
            if ($user->avatar != null && file_exists(public_path('avatar/' . $user->avatar)) && $user->avatar != 'default.jpg') {
                unlink(public_path('avatar/' . $user->avatar));
            }
        }

        $data = DB::table('users')
                ->where('id', $request->id)
                ->update([
                    'id_program' => $request->id_program,
                    'name' => $request->nama_siswa,
                    'no_siswa' => $request->no_siswa,
                    'tempat_lahir' => $request->tempat_lahir,
                    'tanggal_lahir' => date('Y-m-d', strtotime($request->tanggal_lahir)),
                    'email' => $request->email,
                    'avatar' => $fileName
                ]);

        return response()->json([
            'status' => 200,
        ]);
    }

    public function status(Request $request)
    {
        $data = DB::table('users')
            ->where('id', $request->id_status)
            ->update([
                'username' => $request->username_status,
                'password' => bcrypt($request->password_status),
                'password_string' => $request->password_status,
                'status' => $request->status_status,
            ]);

		return response()->json([
			'status' => 200,
		]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = DB::table('users')
                ->where('id', $id)
                ->first();

        // Hapus gambar avatar jika ada
        if (file_exists(public_path('avatar/' . $siswa->avatar)) && $siswa->avatar != 'default.jpg') {
            unlink(public_path('avatar/' . $siswa->avatar));
        }

        $data = DB::table('users')->where('id', $id)->delete();
        $data2 = DB::table('kelas_siswa')->where('id_siswa', $id)->delete();

        return response()->json(200);
    }

    public function apiSiswa()
    {
        $data =  DB::table('users')
                ->select('users.*','program_bimbel.nama_program')
                ->join('program_bimbel','program_bimbel.id','=','users.id_program')
                ->where('users.level','siswa')
                ->orderBy('users.name','asc')
                ->get();

            return Datatables::of($data)
            ->addColumn('action', function ($data) {

                        $button = "
                        <div class=\"row\">
                            <button onclick=\"edit($data->id)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Ubah Siswa\" class=\"btn btn-xs btn-warning rounded-circle\"><i class=\"fa fa-pencil\"></i></button>&nbsp;
                            <button onclick=\"hapus($data->id)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Hapus Siswa $data->name\" class=\"btn btn-xs btn-danger rounded-circle\">
                                <span class=\"fa fa-trash \"></span>
                            </button>&nbsp;
                            <button onclick=\"status($data->id)\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Update Status Siswa $data->name\" class=\"btn btn-xs btn-success rounded-circle\">
                                <span class=\"fa fa-toggle-on \"></span>
                            </button>
                            </div>
                        ";
                        return $button;
                  
                    
            })
            ->editColumn('status', function($data){
                if( $data->status == 'tidak aktif' ){
                    return '<button class="btn btn-sm btn-secondary">tidak aktif</button>';}
                else{
                    return '<button class="btn btn-sm btn-success">aktif</button>';}
            })
            ->addColumn('avatar', function ($data) {
                $avatar = $data->avatar ? asset('avatar/'.$data->avatar) : asset('avatar/dummy.png');
                return '<img src="'.$avatar.'" width="50" height="50">';
            })
            ->addIndexColumn()
            ->rawColumns(['action','status','avatar'])
            ->make(true);
    }

    public function cetak()
    {
        $siswa = DB::table('users')
                    ->join('kelas','kelas.id_program','=','users.id_program')
                    ->join('program_bimbel','program_bimbel.id','=','users.id_program')
                    ->where('level','siswa')
                    ->get();

        return view('admin.siswa.cetak', compact('siswa'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv',
        ]);

        $file = $request->file('file');

        Excel::import(new SiswaImport(), $file);

        return redirect()->back()->with('success', 'Data berhasil import!');
    }
}
