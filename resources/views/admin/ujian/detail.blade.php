@extends('layouts.app')

@section('list-ujian','active')
@section('list-ujian','active')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
<style>
img {
    width: 150px;
}
</style>
@stop

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <a href="/ujian/tambah_soal/{{ $ujian->id }}"  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" >
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Soal</a>
            </div>

            <!-- Page Heading -->
            <!-- <h1 class="h3 mb-2 text-gray-800">Siswa</h1> -->

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Soal {{ $ujian->nama_ujian }}</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Soal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
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
            
            // Data Tables 
            var id_ujian = "{{ $id }}"
            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                          url:"{!! url('/ujian/list_soal') !!}",
                          data: function (i) {
                                  i.id_ujian = id_ujian;
                                },
                      },
                columns: [
                    {data: 'DT_RowIndex',orderable: false, searchable: false},
                    {data: 'soal', name: 'id_soal'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

        });

        function tambah(id){
            $('#addModal').modal('show');
        }

        // $('#formAddModal').submit(function(e){
        //     e.preventDefault();
        //     var formdata = $('#formAddModal').serialize();
        //     $.ajax({
        //         data:formdata,
        //         method:"post",
        //         url:"{{ route('soal-store') }}",
        //         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //         success: function(response){
        //         $('#addModal').modal('hide');

        //             if(response.status == "success"){
        //                 Swal.fire({
        //                 position: 'top-end',
        //                 icon: 'success',
        //                 title: response.message,
        //                 showConfirmButton: false,
        //                 timer: 2000
        //                 }).then(function() {
        //                     // refresh table
        //                     location.reload();
        //                 });

        //             }
        //         },
        //         error:function(error){
        //             if(error.status == 422){
        //                     if(error.responseJSON.errors.soal) {
        //                     //show alert
        //                     $('#alert-soal').removeClass('d-none');
        //                     $('#alert-soal').addClass('d-block');
        //                     //add message to alert
        //                     $('#alert-soal').html(error.responseJSON.errors.soal[0]);
        //                     }else{
        //                         $('#alert-soal').removeClass('d-block');
        //                         $('#alert-soal').addClass('d-none');
        //                     }
        //                 }
        //         }
        //     })
        // })


        function hapus(id){
                Swal.fire({
                title: 'Anda yakin ingin?',
                text: "Menghapus data ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus sekarang!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ url('ujian/delete_soal')}}"+"/"+id,
                            type: "DELETE",
                            data:{
                                "_token" : "{{ csrf_token() }}",
                            },
                            success: function(response){
                                $('#table').DataTable().ajax.reload(null, false);
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Data berhasil dihapus',
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                            },
                            error: function(msg){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: "Data tidak bisa dihapus!",
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                            }
                        })
                        
                    }
                });
        }
        @if(session()->has('success'))
        
        Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: "{{ session('success') }}",
                        showConfirmButton: false,
                        timer: 2000
                    })
        @endif
    </script>
@stop