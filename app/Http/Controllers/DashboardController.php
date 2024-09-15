<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role = Auth::user()->level;
        $id = Auth::user()->id;

        if($role == 'admin' || $role == 'guru'){
            $count_program = DB::table('program_bimbel')->count();
            $count_kelas = DB::table('kelas')->count();
            $count_siswa = DB::table('users')->where('level','siswa')->count();
            $count_guru = DB::table('guru')->count();
    
            return view('dashboard',compact('count_program','count_kelas','count_siswa','count_guru'));
        }else{
            $list_ujian = DB::table('ujian_siswa')
                        ->select('ujian_siswa.*','ujian.nama_ujian')
                        ->join('ujian','ujian.id','=','ujian_siswa.id_ujian')
                        ->where('ujian_siswa.id_siswa', $id)
                        ->get();

            foreach($list_ujian as $data){
                $data->jumlah_soal = DB::table('ujian_soal')->where('id_ujian', $data->id_ujian)->count();
            }
    
            return view('dashboard',compact('list_ujian'));
        }
       
    }

    
}
