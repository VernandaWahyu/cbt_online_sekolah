@extends('layouts.app')

@section('list-siswa','active')
@section('list-siswa','active')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="tambah()">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Siswa</button>
                
                <!-- <a href="{{ url('/siswa/cetak') }}"  class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm" >
                <i class="fas fa-file fa-sm text-white-50"></i> Cetak ID Card</a> -->

            </div>
            <p></p><p></p>

            <!-- Page Heading -->
            <!-- <h1 class="h3 mb-2 text-gray-800">Siswa</h1> -->

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Siswa</h6>
                </div>
                <div class="card-body" id="show_all_employees">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>No. Siswa</th>
                                    <th>Nama Program</th>
                                    <th>Status</th>
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

    
<div class="modal fade" tabindex="-1" id="addModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modalTitle">Tambah Siswa</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST" id="formAddModal" enctype="multipart/form-data">
        @csrf

            <div class="form-group">
                <label for="">Nama Program</label>
                <select class="form-control" name="id_program" id="id_program_add" style="width: 100%;" required>
                    <option selected="" value="" >Pilih Nama Program</option>
                </select>
            </div>

            <div class="form-group">
                <label for="">Nama Siswa</label>
                <input class="form-control" name="nama_siswa" type="text" id="nama_siswa_add" required>
            </div>

            <div class="form-group">
                <label for="">No Siswa</label>
                <input class="form-control" type="text" name="no_siswa" id="no_siswa_add" required>
            </div>

            <div class="form-group">
                <label for="">Email</label>
                <input class="form-control" type="email" name="email" id="email_add" required>
            </div>

            <div class="form-group">
                <label for="">Tempat Lahir</label>
                <input class="form-control" type="text" name="tempat_lahir" id="tempat_lahir_add" required>
            </div>

            <div class="form-group">
                <label for="">Tanggal Lahir</label>
                <input class="form-control" type="text" name="tanggal_lahir" id="tanggal_lahir_add" required>
            </div>

            <div class="form-group">
                <label for="">Foto</label>
                <input class="form-control" type="file" name="avatar">
            </div>
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" id="add_siswa_btn" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" id="statusModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modalTitle">Update Status Siswa</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST" id="formStatusModal" enctype="multipart/form-data">
        @csrf

            <input type="hidden" id="id_status" name="id">

            <div class="form-group">
                <label for="">Username</label>
                <input class="form-control" type="text" name="username" id="username">
            </div>

            <div class="form-group">
                <label for="">Password</label>
                <input class="form-control" type="text" name="password" id="password">
            </div>

            <div class="form-group">
                <label for="">Status</label>
                <select class="form-control" name="status" id="status" style="width: 100%;" required>
                    <option selected="" value="aktif" >aktif</option>
                    <option value="tidak aktif" >tidak aktif</option>
                </select>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" id="status_siswa_btn" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.all.min.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(function () {

            $(document).on('click', '.editIcon', function(e) {

                $.ajax({
                    url : "<?= url('kelas/list_program') ?>",
                    method : "get",
                    success : function(sup){
                        $('#id_program').children('option:not(:first)').remove().end();

                        $.each(sup,function(index,soObj){
                            $('#id_program').append('<option value="'+soObj.id+'"> '+soObj.nama_program+' </option>')
                        });

                    },
                });

                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                url: "{{url('siswa/edit')}}/"+id,
                type: "GET",
                method: 'get',
                dataType: "json",
                success: function(response) {
                    $("#avatar").html(
                    `<img src="/storage/images/${response.data.avatar}" width="100" class="img-fluid img-thumbnail">`);
                    $('#id_program').val(response.data.id_program).trigger('change');
                    $('#nama_siswa').val(response.data.name);
                    $('#no_siswa').val(response.data.no_siswa);
                    // $('#nama_ortu').val(response.data.nama_ortu);
                    // $('#no_ortu').val(response.data.no_ortu);
                    // $('#username').val(response.data.username);
                    $('#email').val(response.data.email);
                    //$('#password').val('');
                    $('#id').val(response.data.id);
                    $("#emp_avatar").val(response.data.avatar);
                    $('#tempat_lahir').val(response.data.tempat_lahir);
                    $('#tanggal_lahir').val(response.data.tanggal_lahir);
                }
                });

                $("#tanggal_lahir").datepicker( {
                    autoclose: true,
                    format: 'dd-mm-yyyy',
                    todayHighlight: true,
                    weekStart: 1,
                });
            });

            // update siswa ajax request
            $("#formEditModal").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#edit_siswa_btn").text('Updating...');
                $.ajax({
                url: "{{ url('siswa/update') }}",
                method: 'post',
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 200) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Data berhasil diubah',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    //fetchAllSiswa();
                    }
                    $("#edit_siswa_btn").text('Update Siswa');
                    $("#formEditModal")[0].reset();
                    $("#editModal").modal('hide');
                    location.reload();
                }
                });
            });

            // add new siswa ajax request
            $("#formAddModal").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#add_siswa_btn").text('Adding...');
                $.ajax({
                url: "{{ url('siswa/store') }}",
                method: 'post',
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 200) {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Data berhasil ditambahkan',
                            showConfirmButton: false,
                            timer: 4000
                        })
                    //fetchAllSiswa();
                    }
                    $("#add_siswa_btn").text('Add Siswa');
                    $("#formAddModal")[0].reset();
                    $("#addModal").modal('hide');
                    location.reload();
                }
                });
            });

            $(document).on('click', '.deleteIcon', function(e) {

                e.preventDefault();
                let id = $(this).attr('id');

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
                            url: "{{ url('siswa/delete')}}"+"/"+id,
                            type: "DELETE",
                            data:{
                                "_token" : "{{ csrf_token() }}",
                            },
                            success: function(response){
                                //$('#table').DataTable().ajax.reload(null, false);
                                location.reload();
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Data berhasil dihapus',
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                            },
                            error: function(msg){
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: "Data tidak bisa dihapus!",
                                    showConfirmButton: false,
                                    timer: 1000
                                })
                            }
                        })
                        
                    }
                });

            });

            $(document).on('click', '.statusIcon', function(e) {

                e.preventDefault();
                let id = $(this).attr('id');
                $.ajax({
                url: "{{url('siswa/edit')}}/"+id,
                type: "GET",
                method: 'get',
                dataType: "json",
                success: function(response) {
                    $('#id_status').val(response.data.id);
                    $('#username').val(response.data.username);
                    $('#password').val(response.data.password_string);
                    $('#status').val(response.data.status).trigger('change');
                }
                });
            });

            // update siswa ajax request
            $("#formStatusModal").submit(function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#status_siswa_btn").text('Updating...');
                $.ajax({
                url: "{{ url('siswa/status') }}",
                method: 'post',
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 200) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Data berhasil diubah',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    //fetchAllSiswa();
                    }
                    $("#status_siswa_btn").text('Update Siswa');
                    $("#formStatusModal")[0].reset();
                    $("#statusModal").modal('hide');
                    location.reload();
                }
                });
            });

        });

        $(document).ready(function(){
            fetchAllSiswa();

            function fetchAllSiswa() {
                $.ajax({
                url: "{{ url('siswa/api') }}",
                method: 'get',
                success: function(response) {
                    $("#show_all_employees").html(response);
                    $("table").DataTable({
                    order: [0, 'desc']
                    });
                }
                });
            }

            $.ajax({
                url : "<?= url('kelas/list_program') ?>",
                method : "get",
                success : function(sup){
                    $('#id_program_add').children('option:not(:first)').remove().end();

                    $.each(sup,function(index,soObj){
                        $('#id_program_add').append('<option value="'+soObj.id+'"> '+soObj.nama_program+' </option>')
                    });

                },
            });

            $('#table').DataTable();

            $(".select2").select2();
            $(".id_program_add").select2();

            $("#tanggal_lahir_add").datepicker( {
                autoclose: true,
	            format: 'dd-mm-yyyy',
				todayHighlight: true,
				weekStart: 1,
            });
        });

        function tambah(){
            $('#addModal').modal('show');
            $("#addModal").css("z-index", "1500");
        }

    </script>
@stop

@section('modal')
<div class="modal fade" tabindex="-1" id="editModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modalTitle">Edit Siswa</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST" id="formEditModal" enctype="multipart/form-data">
        @csrf

            <input type="hidden" id="id" name="id">
            <input type="hidden" id="emp_avatar" name="emp_avatar">

            <div class="form-group">
                <label for="">Nama Program</label>
                <select class="form-control" name="id_program" id="id_program" style="width: 100%;" required>
                    <option selected="" value="" >Pilih Nama Program</option>
                </select>
            </div>

            <div class="form-group">
                <label for="">Nama Siswa</label>
                <input class="form-control" type="text" name="nama_siswa" id="nama_siswa" required>
            </div>

            <div class="form-group">
                <label for="">No Siswa</label>
                <input class="form-control" type="text" name="no_siswa" id="no_siswa" required>
            </div>

            <div class="form-group">
                <label for="">Email</label>
                <input class="form-control" type="email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="">Tempat Lahir</label>
                <input class="form-control" type="text" name="tempat_lahir" id="tempat_lahir" required>
            </div>

            <div class="form-group">
                <label for="">Tanggal Lahir</label>
                <input class="form-control" type="text" name="tanggal_lahir" id="tanggal_lahir" required>
            </div>

            <div class="form-group">
                <label for="">Foto</label>
                <input class="form-control" type="file" name="avatar">
            </div>
            <div class="mt-2" id="avatar">
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" id="edit_siswa_btn" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection