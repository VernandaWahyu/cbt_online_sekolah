<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class UjianSiswaController extends Controller
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
    public function ujian($id_page)
    {
        $id_siswa = Auth::user()->id;

        $cek_page =  DB::table('jawaban_ujian_siswa')->where('id_ujian_siswa', $id_page)->where('id_siswa', Auth::user()->id)->first();

        if($cek_page){
            $id = $cek_page->id;
        }else{
            $id = $id_page+1;
        }
        //dd($id);

        $first = DB::table('jawaban_ujian_siswa')->where('id', $id)->first();

        if($first){
            $nomor = $first->nomor;
        }else{
            return redirect()->back();
        }

        $get_ujian_siswa = DB::table('ujian_siswa')->where('id',$id_page)->first();


        $list_soal = DB::table('jawaban_ujian_siswa')
                    ->select('jawaban_ujian_siswa.*','soal.soal')
                    ->join('soal','soal.id','=','jawaban_ujian_siswa.id_soal')
                    ->where('id_ujian_siswa', $id_page)
                    ->where('jawaban_ujian_siswa.id_siswa', Auth::user()->id)
                    ->orderBy('jawaban_ujian_siswa.id','asc')
                    ->get();

        $list_detail_soal = DB::table('jawaban_ujian_siswa')
                    ->select('jawaban_ujian_siswa.*','soal.soal')
                    ->join('soal','soal.id','=','jawaban_ujian_siswa.id_soal')
                    ->where('id_ujian_siswa', $first->id_ujian_siswa)
                    ->where('jawaban_ujian_siswa.id_siswa', Auth::user()->id)
                    ->where('jawaban_ujian_siswa.nomor', $nomor)
                    ->orderBy('jawaban_ujian_siswa.id','asc')
                    ->first();

        $list_jawaban = DB::table('jawaban')->where('id_soal', $list_soal[0]->id_soal)->get();

        foreach($list_jawaban as $data){
            $cek = DB::table('jawaban_ujian_siswa')->where('id_ujian_siswa', $id_page)->where('id_jawaban', $data->id)->where('jawaban_ujian_siswa.id_siswa', Auth::user()->id)->first();

            if($cek){
                $data->flag = 'true';
            }else{
                $data->flag = 'false';
            }
        }
        $id_jawaban_ujian =  $first->id;
        $id_ujian = $first->id_ujian;
        $ujian_detail = DB::table('ujian')->where('id', $id_ujian)->first();
        //dd($ujian_detail);
        
        return view('siswa.ujian',compact('list_detail_soal','list_soal','list_jawaban','id_jawaban_ujian','nomor','id','id_ujian','ujian_detail'));
       
    }

    public function ujianPage($id_page)
    {
        $cek_page =  DB::table('jawaban_ujian_siswa')->where('id', $id_page)->first();

        if($cek_page){
            $id = $id_page;
        }else{
            $id = $id_page+1;
        }
        //dd($id);

        $first = DB::table('jawaban_ujian_siswa')->where('id', $id)->first();

        if($first){
            $nomor = $first->nomor;
        }else{
            return redirect()->back();
        }
        
        $list_soal = DB::table('jawaban_ujian_siswa')
                    ->select('jawaban_ujian_siswa.*','soal.soal')
                    ->join('soal','soal.id','=','jawaban_ujian_siswa.id_soal')
                    ->where('id_ujian_siswa', $first->id_ujian_siswa)
                    ->where('jawaban_ujian_siswa.id_siswa', Auth::user()->id)
                    ->orderBy('jawaban_ujian_siswa.id','asc')
                    ->get();

        $list_detail_soal = DB::table('jawaban_ujian_siswa')
                    ->select('jawaban_ujian_siswa.*','soal.soal')
                    ->join('soal','soal.id','=','jawaban_ujian_siswa.id_soal')
                    ->where('id_ujian_siswa', $first->id_ujian_siswa)
                    ->where('jawaban_ujian_siswa.id_siswa', Auth::user()->id)
                    ->where('jawaban_ujian_siswa.nomor', $nomor)
                    ->orderBy('jawaban_ujian_siswa.id','asc')
                    ->first();


        $list_jawaban = DB::table('jawaban')->where('id_soal', $first->id_soal)->get();

        foreach($list_jawaban as $data){
            $cek = DB::table('jawaban_ujian_siswa')->where('id_ujian_siswa', $id_page)->where('id_jawaban', $data->id)->where('jawaban_ujian_siswa.id_siswa', Auth::user()->id)->first();

            if($cek){
                $data->flag = 'true';
            }else{
                $data->flag = 'false';
            }
        }

        $id_jawaban_ujian =  $first->id;
        $id_ujian = $first->id_ujian;
        $ujian_detail = DB::table('ujian')->where('id', $id_ujian)->first();

        return view('siswa.ujian_next',compact('list_detail_soal','list_soal','list_jawaban','id_jawaban_ujian','nomor','id','id_ujian','ujian_detail'));
    }

    public function ujianSimpanJawaban(Request $request)
    {
        $id = $request->id;
        $data = DB::table('jawaban_ujian_siswa')
            ->where('id', $id)
            ->update([
                'id_jawaban' => $request->id_jawaban,
            ]);
        
        return $data;
    }

    public function hasilUjian($id)
    {
        $id_ujian = $id;

        $detail_ujian = DB::table('ujian')->where('id', $id_ujian)->first();

        $detail_nilai = DB::table('jawaban_ujian_siswa')
                            ->select('bank_soal.id','bank_soal.nama_bank_soal')
                            ->join('soal','soal.id','=','jawaban_ujian_siswa.id_soal')
                            ->join('bank_soal','bank_soal.id','=','soal.id_bank_soal')
                            ->where('jawaban_ujian_siswa.id_siswa', Auth::user()->id)
                            ->where('jawaban_ujian_siswa.id_ujian', $id_ujian)
                            ->groupBy('bank_soal.id','bank_soal.nama_bank_soal')
                            ->get();

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
        }

        $sum_nilai = DB::table('jawaban_ujian_siswa')
                        ->join('jawaban','jawaban.id','=','jawaban_ujian_siswa.id_jawaban')
                        ->join('soal','soal.id','=','jawaban.id_soal')
                        ->where('jawaban_ujian_siswa.id_siswa', Auth::user()->id)
                        ->where('jawaban_ujian_siswa.id_ujian', $id_ujian)
                        ->sum('jawaban.nilai_jawaban');

        if($sum_nilai < $detail_ujian->nilai_min){
            $flag_lulus = 'false';
        }else{
            $flag_lulus = 'true';
        }
        
        $detail_jawaban = DB::table('jawaban_ujian_siswa')
                            ->join('jawaban','jawaban.id','=','jawaban_ujian_siswa.id_jawaban')
                            ->join('soal','soal.id','=','jawaban.id_soal')
                            ->where('jawaban_ujian_siswa.id_ujian', $id_ujian)
                            ->where('jawaban_ujian_siswa.id_siswa', Auth::user()->id)
                            ->orderBy('jawaban_ujian_siswa.nomor','asc')
                            ->get();
        //dd('hasil');
        return view('siswa.ujian_hasil', compact('sum_nilai','detail_jawaban','flag_lulus','detail_nilai'));
    }

    public function listHasilUjian()
    {   
        $ujian = DB::table('ujian_siswa')
                    ->join('ujian','ujian.id','=','ujian_siswa.id_ujian')
                    ->where('ujian_siswa.id_siswa',Auth::user()->id)
                    ->orderBy('ujian.nama_ujian','asc')
                    ->get();
        
        foreach($ujian as $data){

            $sum_nilai = DB::table('jawaban_ujian_siswa')
                        ->join('jawaban','jawaban.id','=','jawaban_ujian_siswa.id_jawaban')
                        ->where('jawaban_ujian_siswa.id_ujian','2')
                        ->sum('jawaban.nilai_jawaban');

            $update = DB::table('ujian_siswa')->where('id_ujian', $data->id_ujian)
                        ->update([
                            'nilai' => $sum_nilai,
                        ]);
        }
        //dd('hasil');
        return view('siswa.list_ujian_hasil', compact('ujian'));
    }
}
