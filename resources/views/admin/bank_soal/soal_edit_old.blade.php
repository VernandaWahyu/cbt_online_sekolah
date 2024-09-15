@extends('layouts.app')

@section('list-bank-soal','active')
@section('list-bank-soal','active')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
#fieldGroupTemplate {
  display: none;
}

#fieldLabelTemplate {
  display: none;
}
</style>
@stop

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('soal-update',$soal->id) }}" id="formAddModal">

                        <div class="form-group">
                            <label for="">Soal</label>
                            <textarea name="soal" id="soal" class="soal">
                                {{ old('soal',$soal->soal)   }}
                            </textarea>
                           @error ('soal')
                           <div class="alert alert-danger mt-2 " role="alert" id="alert-soal">
                            {{ $message }}
                           </div>
                           @endif
                
                            
                        </div>
                
                        <hr>
                        @foreach ($jawaban as $no => $item)
                            
                        <label for="" id="{{ $no >= 1 ? "fieldLabelTemplate" :"" }}">Nilai</label>
                        <div class="row fieldGroup">
                
                            <div class="col-md-8">
                                <div class="form-group">
                                <input type="text" required name="nilai[]" value="{{ $item->nilai_jawaban }}" id="sectionTitle" class="form-control">
                                </div>
                            </div>
                            
                            @if($no == 0)
                            <div class="col-md-4  ">
                                <a href="javascript:void(0)" class="btn btn-success addMore">
                                <span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Tambahkan Jawaban
                                </a>
                            </div>
                            @else
                            <div class="col-md-4 ">
                                <a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Hapus</a>
                            </div>
                            @endif
                
                            <div class="col-md-12  ">
                                <div class="form-group">
                                <label for="">Jawaban</label>
                                <textarea name="jawaban[]" required class="jawaban" id="jawaban">
                                    {{ $item->jawaban }}
                                </textarea>
                                </div>
                            </div>
                
                       
                
                           
                      </div>
                        @endforeach
                        <div id="newRow">
                                           
                        </div>
                
                        <label for="" id="fieldLabelTemplate">Nilai</label>
                        <div class="row" id="fieldGroupTemplate" >
                
                            <div class="col-md-8">
                                <div class="form-group floating-label">
                                    <input type="text" name="nilai[]" id="sectionTitle" class="form-control">
                                </div>
                            </div>
                
                            <div class="col-md-4 ">
                                <a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Hapus</a>
                            </div>
                
                            <div class="col-sm-12 ">
                                <div class="form-group">
                                <label for="">Jawaban</label>
                                <textarea name="jawaban[]"></textarea>
                                </div>
                            </div>
                        </div>
                      <div class="col-md-4 mb-4">
                        
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </section>
@endsection

@section('js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.11.3/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.11.3/adapters/jquery.js"></script>

    <script>

        $(document).ready(function(){
           

             //section add limit
             var maxGroup = 4;

            // initialize all current editor(s)
            $('.jawaban').ckeditor({
                    filebrowserUploadUrl: "{{route('post.image', ['_token' => csrf_token() ])}}",
                    filebrowserUploadMethod: 'form'
                });

            //add more section
            $(".addMore").click(function() {

            // define the number of existing sections
            var numGroups = $('.fieldGroup').length;

            // check whether the count is less than the maximum
            if (numGroups < maxGroup) {

                // create new section from template
                var $fieldHTML = $('<div>', {
                'class': 'row fieldGroup',
                'html': $("#fieldGroupTemplate").html(),
                });

                // insert new group after last one
                $('.fieldGroup:last').after($fieldHTML);

                // instantiate ckeditor on new textarea
                $fieldHTML.find('textarea').ckeditor({
                    filebrowserUploadUrl: "{{route('post.image', ['_token' => csrf_token() ])}}",
                    filebrowserUploadMethod: 'form'
                });

            } else {
                alert('Maximum ' + maxGroup + ' sections are allowed.');
            }

            });

            //remove fields 
            $("body").on("click", ".remove", function() {
                $(this).parents(".fieldGroup").remove();
            });

            CKEDITOR.replace('soal', {
                filebrowserUploadUrl: "{{route('post.image', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
            CKEDITOR.replace('jawaban', {
                filebrowserUploadUrl: "{{route('post.image', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
            });
            
        });
        
    </script>
@stop
