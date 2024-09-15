

<?php $__env->startSection('list-siswa','active'); ?>
<?php $__env->startSection('list-siswa','active'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="tambah()">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Siswa</button>

                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#importModal">
                <i class="fas fa-upload fa-sm text-white-50"></i> Import Siswa
                </button>
            </div>
            <p></p><p></p>

            <!-- Page Heading -->
            <!-- <h1 class="h3 mb-2 text-gray-800">Siswa</h1> -->

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Siswa</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>No. Siswa</th>
                                    <th>Foto</th>
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

<div class="modal fade" id="addModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modalTitle">Tambah Siswa</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="formAddModal" enctype="multipart/form-data">

            <div class="form-group">
                <label for="">Nama Kelas</label>
                <select class="select2 form-control" id="id_kelas_add" style="width: 100%;" required>
                    <option selected="" value="" >Pilih Nama Kelas</option>
                </select>
            </div>

            <div class="form-group">
                <label for="">Nama Program</label>
                <select class="select2 form-control" id="id_program_add" style="width: 100%;" required>
                    <option selected="" value="" >Pilih Nama Program</option>
                </select>
            </div>

            <div class="form-group">
                <label for="">Nama Siswa</label>
                <input class="form-control" type="text" id="nama_siswa_add" required>
            </div>

            <div class="form-group">
                <label for="">No Siswa</label>
                <input class="form-control" type="text" id="no_siswa_add" required>
            </div>

            <div class="form-group">
                <label for="">Email</label>
                <input class="form-control" type="email" id="email_add" required>
            </div>

            <div class="form-group">
                <label for="">Tempat Lahir</label>
                <input class="form-control" type="text" id="tempat_lahir_add" required>
            </div>

            <div class="form-group">
                <label for="">Tanggal Lahir</label>
                <input class="form-control" type="text" id="tanggal_lahir_add" required>
            </div>

            <div class="form-group">
                <label for="">Foto</label>
                <input class="form-control" type="file" id="avatar_add">
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

<div class="modal fade" id="editModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modalTitle">Edit Siswa</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="formEditModal" enctype="multipart/form-data">
            <input type="hidden" id="id">

            <div class="form-group">
                <label for="">Nama Kelas</label>
                <select class="select2 form-control" id="id_kelas" style="width: 100%;" required>
                    <option selected="" value="" >Pilih Nama Kelas</option>
                </select>
            </div>

            <div class="form-group">
                <label for="">Nama Program</label>
                <select class="select2 form-control" id="id_program" style="width: 100%;" required>
                    <option selected="" value="" >Pilih Nama Program</option>
                </select>
            </div>

            <div class="form-group">
                <label for="">Nama Siswa</label>
                <input class="form-control" type="text" id="nama_siswa" required>
            </div>

            <div class="form-group">
                <label for="">No Siswa</label>
                <input class="form-control" type="text" id="no_siswa" required>
            </div>

            <div class="form-group">
                <label for="">Email</label>
                <input class="form-control" type="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="">Tempat Lahir</label>
                <input class="form-control" type="text" id="tempat_lahir" required>
            </div>

            <div class="form-group">
                <label for="">Tanggal Lahir</label>
                <input class="form-control" type="text" id="tanggal_lahir" required>
            </div>

            <div class="form-group">
                <label for="">Foto</label>
                <input class="form-control" type="file" id="avatar">
            </div>
            <div class="mt-2" id="avatar_show">
           
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.all.min.js"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function () {

            $('#formEditModal').on('submit', function(e){
                e.preventDefault();
                var id_program = $('#id_program').val();
                var id_kelas = $('#id_kelas').val();
                var nama_siswa = $('#nama_siswa').val();
                var no_siswa = $('#no_siswa').val();
                var email = $('#email').val();
                var tempat_lahir = $('#tempat_lahir').val();
                var tanggal_lahir = $('#tanggal_lahir').val();
                var id = $('#id').val();
                var avatar = $('#avatar')[0].files[0]; // Mengambil file avatar yang diunggah

                var formData = new FormData(); // Membuat objek FormData
                formData.append('_token', "<?php echo e(csrf_token()); ?>");
                formData.append('id_program', id_program);
                formData.append('id_kelas', id_kelas);
                formData.append('nama_siswa', nama_siswa);
                formData.append('no_siswa', no_siswa);
                formData.append('email', email);
                formData.append('tempat_lahir', tempat_lahir);
                formData.append('tanggal_lahir', tanggal_lahir);
                formData.append('avatar', avatar);
                formData.append('id', id);
               
                $.ajax({
                    url: "<?php echo e(url('siswa/update')); ?>",
                    type: "POST",
                    data: formData,
                    processData: false, // Mematikan proses pengolahan data
                    contentType: false, // Mematikan penambahan tipe konten
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

            $('#formStatusModal').on('submit', function(e){
                e.preventDefault();
                var id_status = $('#id_status').val();
                var username_status = $('#username_status').val();
                var password_status = $('#password_status').val();
               
                $.ajax({
                    url: "<?php echo e(url('siswa/status')); ?>",
                    type: "POST",
                    data: {
                        '_token' : "<?php echo e(csrf_token()); ?>",
                        'id_status' : id_status,
                        'username_status' : username_status,
                        'password_status' : password_status,
                    },
                    success: function(response){
                        $('#statusModal').modal('hide');
                        $('#table').DataTable().ajax.reload();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Siswa berhasil update status',
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

        });

        $(document).ready(function(){
            
            // $.ajax({
            //     url : "<?= url('kelas/list_program') ?>",
            //     method : "get",
            //     success : function(sup){
            //         $('#id_program_add').children('option:not(:first)').remove().end();

            //         $.each(sup,function(index,soObj){
            //             $('#id_program_add').append('<option value="'+soObj.id+'"> '+soObj.nama_program+' </option>')
            //         });

            //     },
            // });

            $.ajax({
                url : "<?= url('kelas/list_kelas') ?>",
                method : "get",
                success : function(sup){
                    $('#id_kelas_add').children('option:not(:first)').remove().end();

                    $.each(sup,function(index,soObj){
                        $('#id_kelas_add').append('<option value="'+soObj.id+'"> '+soObj.nama_kelas+' </option>')
                    });

                },
            });

            $('#id_kelas_add').on('change', function () {
                var selectedClass = $(this).val();

                // Only make the AJAX call if a class is selected
                if (selectedClass) {
                    // Populate programs dropdown based on the selected class
                    $.ajax({
                        url: "<?= url('kelas/list_program_kelas') ?>",
                        method: "get",
                        data: { id_kelas: selectedClass }, // Send the selected class ID
                        success: function (sup) {
                            $('#id_program_add').children('option:not(:first)').remove().end();
                            $.each(sup, function (index, soObj) {
                                $('#id_program_add').append('<option value="' + soObj.id + '"> ' + soObj.nama_program + ' </option>');
                            });
                        },
                    });
                } else {
                    // If no class is selected, clear the programs dropdown
                    $('#id_program_add').children('option:not(:first)').remove().end();
                }
            });

            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "<?= url("siswa/api") ?>",
                columns: [
                    {data: 'DT_RowIndex',searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'no_siswa', name: 'no_siswa'},
                    {data: 'avatar', name: 'avatar'},
                    {data: 'nama_program', name: 'nama_program'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            $("#tanggal_lahir_add").datepicker( {
                autoclose: true,
	            format: 'dd-mm-yyyy',
				todayHighlight: true,
				weekStart: 1,
            });

            $("#tanggal_lahir").datepicker( {
                autoclose: true,
	            format: 'dd-mm-yyyy',
				todayHighlight: true,
				weekStart: 1,
            });
            
        });

        $('#formAddModal').on('submit', function(e){
            e.preventDefault();
            var id_program = $('#id_program_add').val();
            var id_kelas = $('#id_kelas_add').val();
            var nama_siswa = $('#nama_siswa_add').val();
            var no_siswa = $('#no_siswa_add').val();
            var email = $('#email_add').val();

            var tempat_lahir = $('#tempat_lahir_add').val();
            var tanggal_lahir = $('#tanggal_lahir_add').val();
            var avatar = $('#avatar_add')[0].files[0]; // Mengambil file avatar yang diunggah

            var formData = new FormData(); // Membuat objek FormData
            formData.append('_token', "<?php echo e(csrf_token()); ?>");
            formData.append('id_program', id_program);
            formData.append('id_kelas', id_kelas);
            formData.append('nama_siswa', nama_siswa);
            formData.append('no_siswa', no_siswa);
            formData.append('email', email);
            formData.append('tempat_lahir', tempat_lahir);
            formData.append('tanggal_lahir', tanggal_lahir);
            formData.append('avatar', avatar);

            $.ajax({
                url: "<?php echo e(url('siswa/store')); ?>",
                type: "POST",
                data: formData,
                processData: false, // Mematikan proses pengolahan data
                contentType: false, // Mematikan penambahan tipe konten
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
                            url: "<?php echo e(url('siswa/delete')); ?>"+"/"+id,
                            type: "DELETE",
                            data:{
                                "_token" : "<?php echo e(csrf_token()); ?>",
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

        function status(id){
            $('#statusModal').modal('show');
            $('#id_status').val(id);
        }

        function tambah(id){
            $('#addModal').modal('show');
            $('#id_program_add').val('');
            $('#id_kelas_add').val('');
            $('#nama_siswa_add').val('');
            $('#no_siswa_add').val('');
            $('#email_add').val('');
            
            $('#tempat_lahir_add').val('');
            $('#tanggal_lahir_add').val('');
            $('#avatar_add').val('');
        }

        function edit(id){
            $('#editModal').modal('show');

            $.ajax({
                url : "<?= url('kelas/list_kelas') ?>",
                method : "get",
                success : function(sup){
                    $('#id_kelas').children('option:not(:first)').remove().end();

                    $.each(sup,function(index,soObj){
                        $('#id_kelas').append('<option value="'+soObj.id+'"> '+soObj.nama_kelas+' </option>')
                    });

                },
            });

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

            $.ajax({
                url: "<?php echo e(url('siswa/edit')); ?>/"+id,
                type: "GET",
                dataType: "json",
                success: function(response){
                    $('#id_program').val(response.data.id_program).trigger('change');
                    $('#id_kelas').val(response.data.id_kelas).trigger('change');
                    $('#nama_siswa').val(response.data.name);
                    $('#no_siswa').val(response.data.no_siswa);
                    $('#email').val(response.data.email);
                    $('#tempat_lahir').val(response.data.tempat_lahir);
                    $('#tanggal_lahir').val(response.data.tanggal_lahir);
                    $('#password').val('');
                    $("#avatar_show").html(
                        `<img src="<?php echo e(asset('avatar')); ?>/${response.data.avatar}" width="100" height="100">`
                    );
                    $('#id').val(response.data.id);
                }
          })
        }
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
<div class="modal fade" id="statusModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modalTitle">Update Status Siswa</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="formStatusModal" enctype="multipart/form-data">

            <input type="hidden" id="id_status" name="id_status">

            <div class="form-group">
                <label for="">Username</label>
                <input class="form-control" type="text" name="username_status" id="username_status">
            </div>

            <div class="form-group">
                <label for="">Password</label>
                <input class="form-control" type="password" name="password_status" id="password_status">
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

 <!-- Modal -->
 <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Import Siswa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <form action="<?php echo e(url('siswa/import')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="file" class="col-form-label">File Upload</label>
                <input type="file" name="file" class="form-control">
                <p></p>
                <a href="<?php echo e(url('Contoh Import Siswa.xlsx')); ?>">Contoh Template Import Siswa</a>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\composer\cbt_online_sekolah\resources\views/admin/siswa/index.blade.php ENDPATH**/ ?>