<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;

class SiswaImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        //dd($row);
        // Pemeriksaan nomor siswa sebelum insert
        $existingSiswa = DB::table('users')
            ->where('no_siswa', $row['no_siswa'])
            ->first();

        // Jika nomor siswa sudah ada, lewati proses insert
        if ($existingSiswa) {
            return null;
        }
        
        $kelas = DB::table('kelas')->where('nama_kelas', $row['nama_kelas'])->pluck('id')->first();
        $program = DB::table('program_bimbel')->where('nama_program', $row['nama_program'])->pluck('id')->first();

        $siswa = DB::table('users')
            ->insertGetId([
                'id_program' => $program,
                'name' => $row['nama_siswa'],
                'no_siswa' => $row['no_siswa'],
                'email' => $row['email'],
                'tempat_lahir' => $row['tempat_lahir'],
                'tanggal_lahir' => date('Y-m-d', strtotime($row['tanggal_lahir'])),
                'level' => 'siswa',
                'status' => 'tidak aktif'
            ]);

        $kelas_siswa = DB::table('kelas_siswa')
                    ->insert([
                        'id_siswa' => $siswa,
                        'id_kelas' => $kelas,
                    ]);
    }
}
