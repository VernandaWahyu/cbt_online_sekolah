<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Process\Process;
use Auth;
use Illuminate\Support\Facades\Crypt;

date_default_timezone_set('Asia/Jakarta');
setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function home()
    {
        $user = DB::table('users')
                ->select('users.*','kelas.nama_kelas')
                ->leftjoin('kelas','kelas.id_program','=','users.id_program')
                ->where('users.id',Auth::user()->id)
                ->first();

        $list_ujian = DB::table('ujian_siswa')
                        ->select('ujian.*','ujian_siswa.id as id_ujian_siswa','ujian_siswa.flag')
                        ->join('ujian','ujian.id','=','ujian_siswa.id_ujian')
                        ->where('ujian_siswa.id_siswa',Auth::user()->id)
                        ->orderBy('ujian.nama_ujian','asc')
                        ->get();

        foreach($list_ujian as $key => $data){

            $current_date = date('Y-m-d H:i:s');
            $waktu_mulai = date('Y-m-d H:i:s', strtotime($data->jadwal_mulai));
            $waktu_selesai = date('Y-m-d H:i:s', strtotime($data->jadwal_selesai));

            if($current_date >= $waktu_mulai && $current_date <= $waktu_selesai){
                $data->status = 'running';
            }else if($current_date >= $waktu_selesai){
                $data->status = 'overdue';
            }else{
                $data->status = 'before';
            }

            $data->id_ujian_siswa = Crypt::encrypt($data->id_ujian_siswa);

            if($data->status != 'running'){
                unset($list_ujian[$key]);
            }

        }

        //dd($list_ujian);

        return view('siswa.home', compact('list_ujian','user'));
    }

    public function list()
    {
        $list_ujian = DB::table('ujian_siswa')
                        ->select('ujian.*','ujian_siswa.id as id_ujian_siswa','ujian_siswa.flag')
                        ->join('ujian','ujian.id','=','ujian_siswa.id_ujian')
                        ->where('ujian_siswa.id_siswa',Auth::user()->id)
                        ->orderBy('ujian.nama_ujian','asc')
                        ->get();

        foreach($list_ujian as $data){

            $current_date = date('Y-m-d H:i:s');
            $waktu_mulai = date('Y-m-d H:i:s', strtotime($data->jadwal_mulai));
            $waktu_selesai = date('Y-m-d H:i:s', strtotime($data->jadwal_selesai));

            if($current_date >= $waktu_mulai && $current_date <= $waktu_selesai){
                $data->status = 'running';
            }else if($current_date >= $waktu_selesai){
                $data->status = 'overdue';
            }else{
                $data->status = 'before';
            }

            $data->id_ujian_siswa = Crypt::encrypt($data->id_ujian_siswa);

        }

        //dd($list_ujian);

        return view('siswa.list', compact('list_ujian'));
    }

    public function soal($encryptedIdUjian)
    {
        $id_ujian = Crypt::decrypt($encryptedIdUjian);

        $list_soal = DB::table('jawaban_ujian_siswa')
                    ->select('jawaban_ujian_siswa.*','soal.soal')
                    ->join('soal','soal.id','=','jawaban_ujian_siswa.id_soal')
                    ->where('id_ujian_siswa', $id_ujian)
                    ->where('jawaban_ujian_siswa.id_siswa', Auth::user()->id)
                    ->orderBy('jawaban_ujian_siswa.nomor','asc')
                    ->get();

        foreach($list_soal as $data){
            if($data->id_jawaban == 0){
                $data->flag = 'false';
            }else{
                $data->flag = 'true';
            }

            $data->id = Crypt::encrypt($data->id);
        }

        $soal = DB::table('jawaban_ujian_siswa')
                    ->select('jawaban_ujian_siswa.*','soal.soal','ujian.durasi_min','ujian.durasi_max')
                    ->join('soal','soal.id','=','jawaban_ujian_siswa.id_soal')
                    ->join('ujian','ujian.id','=','jawaban_ujian_siswa.id_ujian')
                    ->where('id_ujian_siswa', $id_ujian)
                    ->where('jawaban_ujian_siswa.id_siswa', Auth::user()->id)
                    ->orderBy('jawaban_ujian_siswa.id','asc')
                    ->first();

        //cek timer tersimpan jika ada
        $timer = DB::table('timer')->where('id_siswa', Auth::user()->id)->where('id_ujian', $soal->id_ujian)->first();

        if($timer){
            $soal->durasi_max = (int)$timer->waktu / 60;
            $soal->durasi_min = $soal->durasi_min;
        }else{
            $soal->durasi_max = $soal->durasi_max;
            $soal->durasi_min = $soal->durasi_min;
        }

        $jawaban = DB::table('jawaban')->where('id_soal', $soal->id_soal)->get();

        foreach($jawaban as $data){
            $cek = DB::table('jawaban_ujian_siswa')
                    ->where('id_ujian_siswa', $id_ujian)
                    ->where('id_jawaban', $data->id)
                    ->where('jawaban_ujian_siswa.id_siswa', Auth::user()->id)
                    ->first();

            if($cek){
                $data->flag = 'true';
            }else{
                $data->flag = 'false';
            }
        }

        $flag_selesai = 'false';

        return view('siswa.soal', compact('soal','list_soal','jawaban','flag_selesai','id_ujian'));
    }

    public function soal_detail($encryptedIdUjian)
    {
        $id = Crypt::decrypt($encryptedIdUjian);
        //dd($id);
        $get_id = DB::table('jawaban_ujian_siswa')->where('id', $id)->first();

        $list_soal = DB::table('jawaban_ujian_siswa')
                    ->select('jawaban_ujian_siswa.*','soal.soal')
                    ->join('soal','soal.id','=','jawaban_ujian_siswa.id_soal')
                    ->where('id_ujian_siswa', $get_id->id_ujian_siswa)
                    ->where('jawaban_ujian_siswa.id_siswa', Auth::user()->id)
                    ->orderBy('jawaban_ujian_siswa.nomor','asc')
                    ->get();

        foreach($list_soal as $data){
            if($data->id_jawaban == 0){
                $data->flag = 'false';
            }else{
                $data->flag = 'true';
            }

            $data->id = Crypt::encrypt($data->id);
        }

        $soal = DB::table('jawaban_ujian_siswa')
                    ->select('jawaban_ujian_siswa.*','soal.soal','ujian.durasi_min','ujian.durasi_max','jawaban_ujian_siswa.id as id_baru')
                    ->join('soal','soal.id','=','jawaban_ujian_siswa.id_soal')
                    ->join('ujian','ujian.id','=','jawaban_ujian_siswa.id_ujian')
                    ->where('id_ujian_siswa', $get_id->id_ujian_siswa)
                    ->where('jawaban_ujian_siswa.id', $id)
                    ->where('jawaban_ujian_siswa.id_siswa', Auth::user()->id)
                    ->orderBy('jawaban_ujian_siswa.id','asc')
                    ->first();

        $soal->id = Crypt::encrypt($soal->id);
        
        $soal->id_ujian = Crypt::encrypt($soal->id_ujian);
        $jawaban = DB::table('jawaban')->where('id_soal', $soal->id_soal)->get();

        foreach($jawaban as $data){
            $cek = DB::table('jawaban_ujian_siswa')
                    ->where('id_ujian_siswa', $get_id->id_ujian_siswa)
                    ->where('id_jawaban', $data->id)
                    ->where('jawaban_ujian_siswa.id_siswa', Auth::user()->id)
                    ->first();

            if($cek){
                $data->flag = 'true';
            }else{
                $data->flag = 'false';
            }
        }

        //cek soal terakhir atau bukan
        $cek = DB::table('jawaban_ujian_siswa')->where('id_ujian_siswa',$get_id->id_ujian_siswa)->orderBy('id','desc')->first();

        if($cek->id == $id){
            $flag_selesai = 'true';
        }else{
            $flag_selesai = 'false';
        }

        return view('siswa.soal', compact('soal','list_soal','jawaban','flag_selesai'));
    }

    public function soal_detail_baru(Request $request)
    {
        $id = $request->input('id_jawaban_siswa');
        //dd($id);
        $get_id = DB::table('jawaban_ujian_siswa')->where('id', $id)->first();

        $list_soal = DB::table('jawaban_ujian_siswa')
                    ->select('jawaban_ujian_siswa.*','soal.soal')
                    ->join('soal','soal.id','=','jawaban_ujian_siswa.id_soal')
                    ->where('id_ujian_siswa', $get_id->id_ujian_siswa)
                    ->where('jawaban_ujian_siswa.id_siswa', Auth::user()->id)
                    ->orderBy('jawaban_ujian_siswa.nomor','asc')
                    ->get();

        foreach($list_soal as $data){
            if($data->id_jawaban == 0){
                $data->flag = 'false';
            }else{
                $data->flag = 'true';
            }

            $data->id = $data->id;
        }

        $soal = DB::table('jawaban_ujian_siswa')
                    ->select('jawaban_ujian_siswa.*','soal.soal','ujian.durasi_min','ujian.durasi_max','jawaban_ujian_siswa.id as id_baru')
                    ->join('soal','soal.id','=','jawaban_ujian_siswa.id_soal')
                    ->join('ujian','ujian.id','=','jawaban_ujian_siswa.id_ujian')
                    ->where('id_ujian_siswa', $get_id->id_ujian_siswa)
                    ->where('jawaban_ujian_siswa.id', $id)
                    ->where('jawaban_ujian_siswa.id_siswa', Auth::user()->id)
                    ->orderBy('jawaban_ujian_siswa.id','asc')
                    ->first();

        $soal->id = $soal->id;
        
        $soal->id_ujian = $soal->id_ujian;
        $jawaban = DB::table('jawaban')->where('id_soal', $soal->id_soal)->get();

        foreach($jawaban as $data){
            $cek = DB::table('jawaban_ujian_siswa')
                    ->where('id_ujian_siswa', $get_id->id_ujian_siswa)
                    ->where('id_jawaban', $data->id)
                    ->where('jawaban_ujian_siswa.id_siswa', Auth::user()->id)
                    ->first();

            if($cek){
                $data->flag = 'true';
            }else{
                $data->flag = 'false';
            }
        }

        //cek soal terakhir atau bukan
        $cek = DB::table('jawaban_ujian_siswa')->where('id_ujian_siswa',$get_id->id_ujian_siswa)->orderBy('id','desc')->first();

        if($cek->id == $id){
            $flag_selesai = 'true';
        }else{
            $flag_selesai = 'false';
        }

        return response()->json(['soal' => $soal, 'list_soal' => $list_soal, 'jawaban' => $jawaban, 'flag_selesai' => $flag_selesai]);
    }

    public function soal_detail_prev(Request $request)
    {
        $parse_id = $request->input('id_jawaban_siswa');
        $id = $parse_id-1;
        //dd($id);
        $get_id = DB::table('jawaban_ujian_siswa')->where('id', $id)->first();

        $list_soal = DB::table('jawaban_ujian_siswa')
                    ->select('jawaban_ujian_siswa.*','soal.soal')
                    ->join('soal','soal.id','=','jawaban_ujian_siswa.id_soal')
                    ->where('id_ujian_siswa', $get_id->id_ujian_siswa)
                    ->where('jawaban_ujian_siswa.id_siswa', Auth::user()->id)
                    ->orderBy('jawaban_ujian_siswa.nomor','asc')
                    ->get();

        foreach($list_soal as $data){
            if($data->id_jawaban == 0){
                $data->flag = 'false';
            }else{
                $data->flag = 'true';
            }

            $data->id = $data->id;
        }

        $soal = DB::table('jawaban_ujian_siswa')
                    ->select('jawaban_ujian_siswa.*','soal.soal','ujian.durasi_min','ujian.durasi_max')
                    ->join('soal','soal.id','=','jawaban_ujian_siswa.id_soal')
                    ->join('ujian','ujian.id','=','jawaban_ujian_siswa.id_ujian')
                    ->where('id_ujian_siswa', $get_id->id_ujian_siswa)
                    ->where('jawaban_ujian_siswa.id', $id)
                    ->where('jawaban_ujian_siswa.id_siswa', Auth::user()->id)
                    ->orderBy('jawaban_ujian_siswa.id','asc')
                    ->first();

        $jawaban = DB::table('jawaban')->where('id_soal', $soal->id_soal)->get();

        foreach($jawaban as $data){
            $cek = DB::table('jawaban_ujian_siswa')
                    ->where('id_ujian_siswa', $get_id->id_ujian_siswa)
                    ->where('id_jawaban', $data->id)
                    ->where('jawaban_ujian_siswa.id_siswa', Auth::user()->id)
                    ->first();

            if($cek){
                $data->flag = 'true';
            }else{
                $data->flag = 'false';
            }
        }

        //cek soal terakhir atau bukan
        $cek = DB::table('jawaban_ujian_siswa')->where('id_ujian_siswa',$get_id->id_ujian_siswa)->orderBy('id','desc')->first();

        if($cek->id == $id){
            $flag_selesai = 'true';
        }else{
            $flag_selesai = 'false';
        }

        return response()->json(['soal' => $soal, 'list_soal' => $list_soal, 'jawaban' => $jawaban, 'flag_selesai' => $flag_selesai]);
    }

    public function soal_detail_next(Request $request)
    {
        $parse_id = $request->input('id_jawaban_siswa');
        $id = $parse_id+1;
        //dd($id);
        $get_id = DB::table('jawaban_ujian_siswa')->where('id', $id)->first();

        $list_soal = DB::table('jawaban_ujian_siswa')
                    ->select('jawaban_ujian_siswa.*','soal.soal')
                    ->join('soal','soal.id','=','jawaban_ujian_siswa.id_soal')
                    ->where('id_ujian_siswa', $get_id->id_ujian_siswa)
                    ->where('jawaban_ujian_siswa.id_siswa', Auth::user()->id)
                    ->orderBy('jawaban_ujian_siswa.nomor','asc')
                    ->get();

        foreach($list_soal as $data){
            if($data->id_jawaban == 0){
                $data->flag = 'false';
            }else{
                $data->flag = 'true';
            }

            $data->id = $data->id;
        }

        $soal = DB::table('jawaban_ujian_siswa')
                    ->select('jawaban_ujian_siswa.*','soal.soal','ujian.durasi_min','ujian.durasi_max')
                    ->join('soal','soal.id','=','jawaban_ujian_siswa.id_soal')
                    ->join('ujian','ujian.id','=','jawaban_ujian_siswa.id_ujian')
                    ->where('id_ujian_siswa', $get_id->id_ujian_siswa)
                    ->where('jawaban_ujian_siswa.id', $id)
                    ->where('jawaban_ujian_siswa.id_siswa', Auth::user()->id)
                    ->orderBy('jawaban_ujian_siswa.id','asc')
                    ->first();

        $soal->id = $soal->id;
        
        $jawaban = DB::table('jawaban')->where('id_soal', $soal->id_soal)->get();

        foreach($jawaban as $data){
            $cek = DB::table('jawaban_ujian_siswa')
                    ->where('id_ujian_siswa', $get_id->id_ujian_siswa)
                    ->where('id_jawaban', $data->id)
                    ->where('jawaban_ujian_siswa.id_siswa', Auth::user()->id)
                    ->first();

            if($cek){
                $data->flag = 'true';
            }else{
                $data->flag = 'false';
            }
        }

        //cek soal terakhir atau bukan
        $cek = DB::table('jawaban_ujian_siswa')->where('id_ujian_siswa',$get_id->id_ujian_siswa)->orderBy('id','desc')->first();

        if($cek->id == $id){
            $flag_selesai = 'true';
        }else{
            $flag_selesai = 'false';
        }

        return response()->json(['soal' => $soal, 'list_soal' => $list_soal, 'jawaban' => $jawaban, 'flag_selesai' => $flag_selesai]);
    }

    public function confirm($encryptedIdUjian)
    {
        $id = Crypt::decrypt($encryptedIdUjian);

        $ujian = DB::table('ujian_siswa')
                        ->select('ujian.*','ujian_siswa.id as id_ujian_siswa')
                        ->join('ujian','ujian.id','=','ujian_siswa.id_ujian')
                        ->where('ujian_siswa.id', $id)
                        ->orderBy('ujian.nama_ujian','asc')
                        ->first();

        $sum_soal = DB::table('jawaban_ujian_siswa')
                        ->where('id_ujian_siswa', $ujian->id_ujian_siswa)
                        ->count();

        $ujian->id_ujian_siswa = Crypt::encrypt($ujian->id_ujian_siswa);

        return view('siswa.confirm', compact('ujian','sum_soal'));
    }

    public function profile()
    {
        $profile = DB::table('users')
                    ->join('kelas','kelas.id_program','=','users.id_program')
                    ->join('program_bimbel','program_bimbel.id','=','users.id_program')
                    ->where('users.id', Auth::user()->id)
                    ->first();

        return view('siswa.profile', compact('profile'));
    }

    public function profile_update(Request $request)
    {
        $update = DB::table('users')->where('id', Auth::user()->id)
                    ->update([
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                    ]);

        return redirect()->back()->with('success',"Profile berhasil diperbaharui");;

    }

    public function ujianResetJawaban(Request $request)
    {
        $id = $request->id;

        //cek nilai jawaban
        //$jawaban = DB::table('jawaban')->where('id', $request->id_jawaban)->first();

        $data = DB::table('jawaban_ujian_siswa')
            ->where('id', $id)
            ->update([
                'id_jawaban' => $request->id_jawaban,
                'nilai_jawaban' => 0
            ]);
        
        return $id;
    }

    public function ujianSimpanJawaban(Request $request)
    {
        $id = $request->id;

        //cek nilai jawaban
        $jawaban = DB::table('jawaban')->where('id', $request->id_jawaban)->first();

        $data = DB::table('jawaban_ujian_siswa')
            ->where('id', $id)
            ->update([
                'id_jawaban' => $request->id_jawaban,
                'nilai_jawaban' => $jawaban->nilai_jawaban
            ]);
        
        return $data;
    }

    public function hasilUjian($encryptedIdUjian)
    {
        $id_ujian = $encryptedIdUjian;
        //$id_ujian = $id;
        
        $detail_ujian = DB::table('ujian')->where('id', $id_ujian)->first();

        $detail_nilai = DB::table('jawaban_ujian_siswa')
                            ->select('bank_soal.id','bank_soal.nama_bank_soal','bank_soal.passing_grade')
                            ->join('soal','soal.id','=','jawaban_ujian_siswa.id_soal')
                            ->join('bank_soal','bank_soal.id','=','soal.id_bank_soal')
                            ->where('jawaban_ujian_siswa.id_siswa', Auth::user()->id)
                            ->where('jawaban_ujian_siswa.id_ujian', $id_ujian)
                            ->groupBy('bank_soal.id','bank_soal.nama_bank_soal','bank_soal.passing_grade')
                            ->get();

        $total_nilai = 0;
        $total_pg = 0;
        foreach($detail_nilai as $data){

            $sum_nilai = DB::table('jawaban_ujian_siswa')
                        ->join('jawaban','jawaban.id','=','jawaban_ujian_siswa.id_jawaban')
                        ->join('soal','soal.id','=','jawaban.id_soal')
                        ->join('bank_soal','bank_soal.id','=','soal.id_bank_soal')
                        ->where('jawaban_ujian_siswa.id_siswa', Auth::user()->id)
                        ->where('jawaban_ujian_siswa.id_ujian', $id_ujian)
                        ->where('soal.id_bank_soal', $data->id)
                        ->sum('jawaban.nilai_jawaban');

            $data->nilai = $sum_nilai;
            $total_nilai = $total_nilai + $sum_nilai;
            $total_pg = $total_pg + $data->passing_grade;
        }

         //update flag
         $update_flag = DB::table('ujian_siswa')
                        ->where('id_ujian', $id_ujian)
                        ->where('id_siswa', Auth::user()->id)
                        ->update([
                            'flag' => 'true',
                            'nilai' => $total_nilai
                        ]);
        

        return view('siswa.selesai');
    }

    public function loadUjian(Request $request)
    {
        $page = $request->input('page'); // Mengambil nilai 'page' dari permintaan, default: 1
        $perPage = $request->input('perPage'); // Mengambil nilai 'perPage' dari permintaan, default: 10

        $offset = ($page - 1) * $perPage;

        $ujian = DB::table('ujian_siswa')
                        ->select('ujian.*','ujian_siswa.id as id_ujian_siswa','ujian_siswa.flag')
                        ->join('ujian','ujian.id','=','ujian_siswa.id_ujian')
                        ->where('ujian_siswa.id_siswa',Auth::user()->id)
                        ->orderBy('ujian.nama_ujian','asc')
                        ->offset($offset)
                        ->limit($perPage)
                        ->get();

        foreach($ujian as $data){

            $current_date = date('Y-m-d H:i:s');
            $waktu_mulai = date('Y-m-d H:i:s', strtotime($data->jadwal_mulai));
            $waktu_selesai = date('Y-m-d H:i:s', strtotime($data->jadwal_selesai));

            if($current_date >= $waktu_mulai && $current_date <= $waktu_selesai){
                $data->status = 'running';
            }else if($current_date >= $waktu_selesai){
                $data->status = 'overdue';
            }else{
                $data->status = 'before';
            }

            $data->id = Crypt::encrypt($data->id);
            $data->id_ujian_siswa = Crypt::encrypt($data->id_ujian_siswa);

        }

        return response()->json($ujian);
    }

    public function updateTimer(Request $request)
    {
        $time = $request->time;
        $id_ujian = $request->id_ujian;
        $id_siswa = Auth::user()->id;

        $data = DB::table('timer')->updateOrInsert(
            ['id_ujian' => $id_ujian, 'id_siswa' => $id_siswa], // Condition to find existing record, in this case, matching 'id'
            [   // Data to update or insert
                'waktu' => $time,
            ]
        );
        
        return $data;
    }

    public function resetUjian($encryptedIdUjian)
    {
        $id_ujian = $encryptedIdUjian;
    
        $ujian_siswa = DB::table('ujian_siswa')->where('id_ujian', $id_ujian)
                    ->update([
                        'flag' => 'false',
                        'nilai' => 0
                    ]);

        $jawaban_ujian_siswa = DB::table('jawaban_ujian_siswa')
                            ->where('id_ujian', $id_ujian)
                            ->where('id_siswa', Auth::user()->id)
                            ->update([
                                'id_jawaban' => 0,
                                'nilai_jawaban' => 0,
                            ]);

        $timer = DB::table('timer')->where('id_siswa', Auth::user()->id)->where('id_ujian', $id_ujian)->delete();

        $this->soal($encryptedIdUjian);
        
    }
}
