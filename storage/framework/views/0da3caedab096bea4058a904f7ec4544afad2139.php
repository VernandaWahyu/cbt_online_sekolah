

<?php $__env->startSection('list-bank-soal','active'); ?>
<?php $__env->startSection('list-bank-soal','active'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="tambah()">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Bank Soal</button>
            </div>

            <!-- Page Heading -->
            <!-- <h1 class="h3 mb-2 text-gray-800">Siswa</h1> -->

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Bank Soal</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Bank Soal</th>
                                    <th>Guru</th>
                                    <th>Passing Grade</th>
                                    <th>Deskripsi</th>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.all.min.js"></script>
    <script>
        $(function () {

            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "<?= url("bank_soal/api") ?>",
                columns: [
                    {data: 'DT_RowIndex',searchable: false},
                    {data: 'nama_bank_soal', name: 'nama_bank_soal'},
                    {data: 'nama_guru', name: 'nama_guru'},
                    {data: 'passing_grade', name: 'passing_grade'},
                    {data: 'deskripsi', name: 'deskripsi'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            $('#formEditModal').on('submit', function(e){
                e.preventDefault();
                var id_guru = $('#id_guru').val();
                var nama_bank_soal = $('#nama_bank_soal').val();
                var passing_grade = $('#passing_grade').val();
                var deskripsi = $('#deskripsi').val();
                var id = $('#id').val();
               
                $.ajax({
                    url: "<?php echo e(url('bank_soal/update')); ?>",
                    type: "POST",
                    data: {
                        '_token' : "<?php echo e(csrf_token()); ?>",
                        'id' : id,
                        'id_guru' : id_guru,
                        'nama_bank_soal' : nama_bank_soal,
                        'passing_grade' : passing_grade,
                        'deskripsi' : deskripsi,
                       
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

        $(document).ready(function(){
            $.ajax({
                url : "<?= url('bank_soal/list_guru') ?>",
                method : "get",
                success : function(sup){
                    $('#id_guru_add').children('option:not(:first)').remove().end();

                    $.each(sup,function(index,soObj){
                        $('#id_guru_add').append('<option value="'+soObj.id+'"> '+soObj.nama_guru+' </option>')
                    });

                },
            });
        });

        $('#formAddModal').on('submit', function(e){
            e.preventDefault();
            var id_guru = $('#id_guru_add').val();
            var nama_bank_soal = $('#nama_bank_soal_add').val();
            var passing_grade = $('#passing_grade_add').val();
            var deskripsi = $('#deskripsi_add').val();
            
            $.ajax({
                url: "<?php echo e(url('bank_soal/store')); ?>",
                type: "POST",
                data: {
                    '_token' : "<?php echo e(csrf_token()); ?>",
                    'id_guru' : id_guru,
                    'nama_bank_soal' : nama_bank_soal,
                    'passing_grade' : passing_grade,
                    'deskripsi' : deskripsi,
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
                            url: "<?php echo e(url('bank_soal/delete')); ?>"+"/"+id,
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

        function tambah(id){
            $('#addModal').modal('show');
            $('#id_guru_add').val('');
            $('#nama_bank_soal_add').val('');
            $('#passing_grade_add').val('');
            $('#deskripsi_add').val('');
        }

        function edit(id){
            $('#editModal').modal('show');

            $.ajax({
                url : "<?= url('bank_soal/list_guru') ?>",
                method : "get",
                success : function(sup){
                    $('#id_guru').children('option:not(:first)').remove().end();

                    $.each(sup,function(index,soObj){
                        $('#id_guru').append('<option value="'+soObj.id+'"> '+soObj.nama_guru+' </option>')
                    });

                },
            });

            $.ajax({
                url: "<?php echo e(url('bank_soal/edit')); ?>/"+id,
                type: "GET",
                dataType: "json",
                success: function(response){
                    $('#id_guru').val(response.data.id_guru).trigger('change');
                    $('#nama_bank_soal').val(response.data.nama_bank_soal);
                    $('#passing_grade').val(response.data.passing_grade);
                    $('#deskripsi').val(response.data.deskripsi);
                    $('#id').val(response.data.id);
                }
          })
        }

        function detail(id){
            window.location.href="<?php echo e(url('bank_soal/detail')); ?>"+"/"+id;
        }
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
<div class="modal fade" id="editModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modalTitle">Edit Bank Soal</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="formEditModal">
            <input type="hidden" id="id">

            <div class="form-group">
                <label for="">Nama Guru</label>
                <select class="select2 form-control" id="id_guru" style="width: 100%;" required>
                    <option selected="" value="" >Pilih Guru</option>
                </select>
            </div>

            <div class="form-group">
                <label for="">Nama Bank Soal</label>
                <input class="form-control" type="text" id="nama_bank_soal" required>
            </div>

            <div class="form-group">
                <label for="">Passing Grade</label>
                <input class="form-control" type="number" id="passing_grade" required>
            </div>

            <div class="form-group">
                <label for="">Deskripsi</label>
                <input class="form-control" type="text" id="deskripsi" required>
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
        <h3 class="modal-title" id="modalTitle">Tambah Bank Soal</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="formAddModal">

            <div class="form-group">
                <label for="">Nama Guru</label>
                <select class="select2 form-control" id="id_guru_add" style="width: 100%;" required>
                    <option selected="" value="" >Pilih Guru</option>
                </select>
            </div>

            <div class="form-group">
                <label for="">Nama Bank Soal</label>
                <input class="form-control" type="text" id="nama_bank_soal_add" required>
            </div>

            <div class="form-group">
                <label for="">Passing Grade</label>
                <input class="form-control" type="number" id="passing_grade_add" required>
            </div>

            <div class="form-group">
                <label for="">Deskripsi</label>
                <input class="form-control" type="text" id="deskripsi_add" required>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\composer\cbt_online_sekolah\resources\views/admin/bank_soal/index.blade.php ENDPATH**/ ?>