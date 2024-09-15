<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Soal</title>
</head>
<body>
    <center><h2>{{ $nama_bank_soal }}</h2></center>
    <?php $no = 1; ?>
    @foreach($soal as $raw)
        <!-- <p><span>{{ $no++ }}.</span> {!! $raw->soal !!}</p> -->
        <table>
            <tr>
                <td>{{ $loop->iteration }}.</td>
                <td>{!! $raw->soal !!}</td>
            </tr>
        </table>
        <?php 
            $jawaban = DB::table('jawaban')->where('id_soal', $raw->id)->orderBy('no_jawaban','asc')->get();

            foreach($jawaban as $j){
                if($j->no_jawaban == '1'){
                    $abjad = 'a';
                }elseif($j->no_jawaban == '2'){
                    $abjad = 'b';
                }elseif($j->no_jawaban == '3'){
                    $abjad = 'c';
                }elseif($j->no_jawaban == '4'){
                    $abjad = 'd';
                }elseif($j->no_jawaban == '5'){
                    $abjad = 'e';
                }

                $j->abjad = $abjad;
            }
        ?>
        @foreach($jawaban as $data)
        <?php
            $max = DB::table('jawaban')->where('id_soal', $data->id_soal)->orderBy('nilai_jawaban','desc')->first();
        ?>
        <table style="margin-top: -30px;">
            <tr>
                <td>{{ $data->abjad }}.</td>
                <td>{!! $data->jawaban !!}</td>
            </tr>
        </table>
        @endforeach
        @if($opsi == 'jawaban')
        <table style="margin-top: -30px;">
            <tr>
                <td>Jawaban :</td>
                <td>{!! $max->jawaban !!}</td>
            </tr>
        </table>
        @endif
    @endforeach
</body>
</html>