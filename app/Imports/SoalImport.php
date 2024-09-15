<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\Soal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;

class SoalImport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        //dd($row['id_bank_soal']);
        return new Soal([
           'id_bank_soal'   => $row['id_bank_soal'],
           'soal'           => $row['soal'],
        ]);
    }
}
