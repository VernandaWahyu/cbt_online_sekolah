@extends('layouts.app')

@section('list-guru','active')
@section('list-guru','active')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop

@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="tambah()">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Guru</button>
            </div>

            <!-- Page Heading -->
            <!-- <h1 class="h3 mb-2 text-gray-800">Siswa</h1> -->

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Guru</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Guru</th>
                                    <th>No. Guru</th>
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
    <script>
        $(function () {

            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "<?= url("guru/api") ?>",
                columns: [
                    {data: 'DT_RowIndex',searchable: false},
                    {data: 'nama_guru', name: 'nama_guru'},
                    {data: 'no_guru', name: 'no_guru'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            $('#formEditModal').on('submit', function(e){
                e.preventDefault();
                var nama_guru = $('#nama_guru').val();
                var no_guru = $('#no_guru').val();
                var email = $('#email').val();
                var username = $('#username').val();
                var password = $('#password').val();
                var id = $('#id').val();
               
                $.ajax({
                    url: "{{ url('guru/update') }}",
                    type: "POST",
                    data: {
                        '_token' : "{{csrf_token()}}",
                        'id' : id,
                        'nama_guru' : nama_guru,
                        'no_guru' : no_guru,
                        'email' : email,
                        'username' : username,
                        'password' : password,
                       
                    },
                    success: function(response){
                        $('#editModal').modal('hide');
                        $('#table').DataTable().ajax.reload();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        })
                    },
                    error: function(xhr, status, error){
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: "Oops, ada sesuatu yang salah!",
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                })
            });

            $(".select2").select2();

            $("#datepicker").datepicker( {
                format: " yyyy", // Notice the Extra space at the beginning
                viewMode: "years", 
                minViewMode: "years"
            });

           

        });

        $('#formAddModal').on('submit', function(e){
            e.preventDefault();
            var nama_guru = $('#nama_guru_add').val();
            var no_guru = $('#no_guru_add').val();
            var email = $('#email_add').val();
            var username = $('#username_add').val();
            var password = $('#password_add').val();
            
            $.ajax({
                url: "{{ url('guru/store') }}",
                type: "POST",
                data: {
                    '_token' : "{{csrf_token()}}",
                    'nama_guru' : nama_guru,
                    'no_guru' : no_guru,
                    'email' : email,
                    'username' : username,
                    'password' : password,
                },
                success: function(response){
                    $('#addModal').modal('hide');
                    $('#table').DataTable().ajax.reload();
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000
                    })
                },
                error: function(xhr, status, error){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: "Oops, ada sesuatu yang salah!",
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            })
        });

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
                            url: "{{ url('guru/delete')}}"+"/"+id,
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

        function tambah(id){
            $('#addModal').modal('show');
            $('#nama_guru_add').val('');
            $('#no_guru_add').val('');
            $('#email_add').val('');
            $('#username_add').val('');
            $('#password_add').val('');
        }

        function edit(id){
            $('#editModal').modal('show');

            $.ajax({
                url: "{{url('guru/edit')}}/"+id,
                type: "GET",
                dataType: "json",
                success: function(response){
                    $('#nama_guru').val(response.data.nama_guru);
                    $('#no_guru').val(response.data.no_guru);
                    $('#email').val(response.data.email);
                    $('#username').val(response.data.username);
                    $('#password').val('');
                    $('#id').val(response.data.id);
                }
          })
        }
    </script>
@stop

@section('modal')
<div class="modal fade" id="editModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modalTitle">Edit Guru</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="formEditModal">
            <input type="hidden" id="id">

            <div class="form-group">
                <label for="">Nama Guru</label>
                <input class="form-control" type="text" id="nama_guru" required>
            </div>

            <div class="form-group">
                <label for="">No. Guru</label>
                <input class="form-control" type="text" id="no_guru" required>
            </div>

            <div class="form-group">
                <label for="">Email</label>
                <input class="form-control" type="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="">Username</label>
                <input class="form-control" type="text" id="username" required>
            </div>

            <div class="form-group">
                <label for="">Password</label>
                <input class="form-control" type="password" id="password">
            </div>
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modalTitle">Tambah Guru</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="formAddModal">

            <div class="form-group">
                <label for="">Nama Guru</label>
                <input class="form-control" type="text" id="nama_guru_add" required>
            </div>

            <div class="form-group">
                <label for="">No. Guru</label>
                <input class="form-control" type="text" id="no_guru_add" required>
            </div>

            <div class="form-group">
                <label for="">Email</label>
                <input class="form-control" type="email" id="email_add" required>
            </div>

            <div class="form-group">
                <label for="">Username</label>
                <input class="form-control" type="text" id="username_add" required>
            </div>

            <div class="form-group">
                <label for="">Password</label>
                <input class="form-control" type="password" id="password_add" required>
            </div>
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection