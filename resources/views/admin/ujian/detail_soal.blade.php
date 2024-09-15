@extends('layouts.app')

@section('list-ujian','active')
@section('list-ujian','active')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">

                <div class="card-body">

                {!! $soal->soal !!}
                <?php 
                    $jawaban = DB::table('jawaban')->where('id_soal', $soal->id)->orderBy('no_jawaban','asc')->get();

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
                <table border="1px">
                    <tr>
                        <td>{{ $data->abjad }}.</td>
                        <td>{!! $data->jawaban !!}</td>
                    </tr>
                </table>
                @endforeach

                </div>

            </div>

        </div>
        <!-- /.container-fluid -->

    </section>
@endsection

@section('js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.all.min.js"></script>
    <script>

        $(function () {
          

        });

    </script>
@stop