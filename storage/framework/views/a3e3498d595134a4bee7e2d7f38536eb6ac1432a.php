

<?php $__env->startSection('list-ujian','active'); ?>
<?php $__env->startSection('list-ujian','active'); ?>

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
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Ujian</button>
            </div>

            <!-- Page Heading -->
            <!-- <h1 class="h3 mb-2 text-gray-800">Siswa</h1> -->

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Ujian</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Ujian</th>
                                    <!-- <th>Kategori Ujian</th> -->
                                    <th>Jadwal Mulai</th>
                                    <th>Jadwal Selesai</th>
                                    <th>Durasi Min</th>
                                    <th>Durasi Max</th>
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
    <script src="https://cdn.jsdelivr.net/npm/html-duration-picker@latest/dist/html-duration-picker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(function () {

            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "<?= url("ujian/api") ?>",
                columns: [
                    {data: 'DT_RowIndex',searchable: false},
                    {data: 'nama_ujian', name: 'nama_ujian'},
                    // {data: 'nama_kategori', name: 'nama_kategori'},
                    {data: 'jadwal_mulai', name: 'jadwal_mulai'},
                    {data: 'jadwal_selesai', name: 'jadwal_selesai'},
                    {data: 'durasi_min', name: 'durasi_min'},
                    {data: 'durasi_max', name: 'durasi_max'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            $('#formEditModal').on('submit', function(e){
                e.preventDefault();
                var id_kategori = $('#id_kategori').val();
                var nama_ujian = $('#nama_ujian').val();
                // var urutan_soal = $('#urutan_soal').val();
                // var urutan_jawaban = $('#urutan_jawaban').val();
                var jadwal_mulai = $('#jadwal_mulai').val();
                var jadwal_selesai = $('#jadwal_selesai').val();
                var waktu_mulai = $('#waktu_mulai').val();
                var waktu_selesai = $('#waktu_selesai').val();
                var durasi_min = $('#durasi_min').val();
                var durasi_max = $('#durasi_max').val();
                var id = $('#id').val();
               
                $.ajax({
                    url: "<?php echo e(url('ujian/update')); ?>",
                    type: "POST",
                    data: {
                        '_token' : "<?php echo e(csrf_token()); ?>",
                        'id' : id,
                        //'id_kategori' : id_kategori,
                        'nama_ujian' : nama_ujian,
                        // 'urutan_soal' : urutan_soal,
                        // 'urutan_jawaban' : urutan_jawaban,
                        'jadwal_mulai' : jadwal_mulai,
                        'jadwal_selesai' : jadwal_selesai,
                        'waktu_mulai' : waktu_mulai,
                        'waktu_selesai' : waktu_selesai,
                        'durasi_min' : durasi_min,
                        'durasi_max' : durasi_max,
                       
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
            // $.ajax({
            //     url : "<?= url('ujian/list_kategori_ujian') ?>",
            //     method : "get",
            //     success : function(sup){
            //         $('#id_kategori_add').children('option:not(:first)').remove().end();

            //         $.each(sup,function(index,soObj){
            //             $('#id_kategori_add').append('<option value="'+soObj.id+'"> '+soObj.nama_kategori+' </option>')
            //         });

            //     },
            // });

            //decalre nama pembuat
            var nama_pembuat = <?php echo json_encode(Auth::user()->name); ?>;
            $('#nama_pembuat_add').val(nama_pembuat);
            $('#nama_pembuat').val(nama_pembuat);
        });

        $('#formAddModal').on('submit', function(e){
            e.preventDefault();
            //var id_kategori = $('#id_kategori_add').val();
            var nama_ujian = $('#nama_ujian_add').val();
            // var urutan_soal = $('#urutan_soal_add').val();
            // var urutan_jawaban = $('#urutan_jawaban_add').val();
            var jadwal_mulai = $('#jadwal_mulai_add').val();
            var jadwal_selesai = $('#jadwal_selesai_add').val();
            var waktu_mulai = $('#waktu_mulai_add').val();
            var waktu_selesai = $('#waktu_selesai_add').val();
            var durasi_min = $('#durasi_min_add').val();
            var durasi_max = $('#durasi_max_add').val();
            
            $.ajax({
                url: "<?php echo e(url('ujian/store')); ?>",
                type: "POST",
                data: {
                    '_token' : "<?php echo e(csrf_token()); ?>",
                    //'id_kategori' : id_kategori,
                    'nama_ujian' : nama_ujian,
                    // 'urutan_soal' : urutan_soal,
                    // 'urutan_jawaban' : urutan_jawaban,
                    'jadwal_mulai' : jadwal_mulai,
                    'jadwal_selesai' : jadwal_selesai,
                    'waktu_mulai' : waktu_mulai,
                    'waktu_selesai' : waktu_selesai,
                    'durasi_min' : durasi_min,
                    'durasi_max' : durasi_max,
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
                            url: "<?php echo e(url('ujian/delete')); ?>"+"/"+id,
                            type: "DELETE",
                            data:{
                                "_token" : "<?php echo e(csrf_token()); ?>",
                            },
                            success: function(response){
                                $('#table').DataTable().ajax.reload(null, false);
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
        }

        function tambah(id){
            $('#addModal').modal('show');
            //$('#id_kategori_add').val('');
            $('#nama_ujian_add').val('');
            // $('#urutan_soal_add').val('');
            // $('#urutan_jawaban_add').val('');
            $('#jadwal_mulai_add').val('');
            $('#jadwal_selesai_add').val('');
            $('#waktu_mulai_add').val('');
            $('#waktu_selesai_add').val('');
            $('#durasi_min_add').val('');
            $('#durasi_max_add').val('');

            $('#jadwal_mulai_add').datepicker({
	            autoclose: true,
	            format: 'dd-mm-yyyy',
				todayHighlight: true,
				weekStart: 1,
	        });

            $('#jadwal_selesai_add').datepicker({
	            autoclose: true,
	            format: 'dd-mm-yyyy',
				todayHighlight: true,
				weekStart: 1,
	        });

            $('#waktu_mulai_add').clockpicker({
                donetext: 'Done',
                placement: 'top'
            });

            $('#waktu_selesai_add').clockpicker({
                donetext: 'Done',
                placement: 'top'
            });
        }

        function edit(id){
            $('#editModal').modal('show');

            $('#jadwal_mulai').datepicker({
	            autoclose: true,
	            format: 'dd-mm-yyyy',
				todayHighlight: true,
				weekStart: 1,
	        });

            $('#jadwal_selesai').datepicker({
	            autoclose: true,
	            format: 'dd-mm-yyyy',
				todayHighlight: true,
				weekStart: 1,
	        });

            $('#waktu_mulai').clockpicker({
                donetext: 'Done',
                placement: 'top'
            });

            $('#waktu_selesai').clockpicker({
                donetext: 'Done',
                placement: 'top'
            });

            // $.ajax({
            //     url : "<?= url('ujian/list_kategori_ujian') ?>",
            //     method : "get",
            //     success : function(sup){
            //         $('#id_kategori').children('option:not(:first)').remove().end();

            //         $.each(sup,function(index,soObj){
            //             $('#id_kategori').append('<option value="'+soObj.id+'"> '+soObj.nama_kategori+' </option>')
            //         });

            //     },
            // });

            $.ajax({
                url: "<?php echo e(url('ujian/edit')); ?>/"+id,
                type: "GET",
                dataType: "json",
                success: function(response){
                    //$('#id_kategori').val(response.data.id_kategori).trigger('change');
                    $('#id').val(response.data.id);
                    $('#nama_ujian').val(response.data.nama_ujian);
                    // $('#urutan_soal').val(response.data.urutan_soal).trigger('change');
                    // $('#urutan_jawaban').val(response.data.urutan_jawaban).trigger('change');
                    $('#jadwal_mulai').val(response.data.jadwal_mulai);
                    $('#jadwal_selesai').val(response.data.jadwal_selesai);
                    $('#waktu_mulai').val(response.data.waktu_mulai);
                    $('#waktu_selesai').val(response.data.waktu_selesai);
                    $('#durasi_min').val(response.data.durasi_min);
                    $('#durasi_max').val(response.data.durasi_max);
                }
          })
        }

        function detail(id){
            window.location.href="<?php echo e(url('ujian/detail')); ?>"+"/"+id;
        }

        function list_siswa(id){
            window.location.href="<?php echo e(url('ujian/list_siswa')); ?>"+"/"+id;
        }
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
<div class="modal fade" id="editModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modalTitle">Edit Ujian</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="formEditModal">
            <input type="hidden" id="id">

            <div class="form-group">
                <label for="">Nama Ujian</label>
                <input class="form-control" type="text" id="nama_ujian" required>
            </div>

            <!-- <div class="form-group">
                <label for="">Kategori Ujian</label>
                <select class="select2 form-control" id="id_kategori" style="width: 100%;" required>
                    <option selected="" value="" >Pilih Kategori Ujian</option>
                </select>
            </div> -->

            <!-- <div class="form-group">
                <label for="">Urutan Soal</label>
                <select class="select2 form-control" id="urutan_soal" style="width: 100%;">
                    <option selected="" value="" >Tipe Urutan</option>
                    <option value="urut" >Urut</option>
                    <option value="acak" >Acak</option>
                </select>
            </div>

            <div class="form-group">
                <label for="">Urutan Jawaban</label>
                <select class="select2 form-control" id="urutan_jawaban" style="width: 100%;">
                    <option selected="" value="" >Tipe Urutan</option>
                    <option value="urut" >Urut</option>
                    <option value="acak" >Acak</option>
                </select>
            </div> -->

            <div class="form-group">
                <label for="">Jadwal Mulai</label>
                <input class="form-control" type="text" id="jadwal_mulai" required>
            </div>

            <div class="form-group">
                <label for="">Waktu Mulai</label>
                <input class="form-control" type="text" id="waktu_mulai" required>
            </div>

            <div class="form-group">
                <label for="">Jadwal Selesai</label>
                <input class="form-control" type="text" id="jadwal_selesai" required>
            </div>

            <div class="form-group">
                <label for="">Waktu Selesai</label>
                <input class="form-control" type="text" id="waktu_selesai" required>
            </div>


            <div class="form-group">
                <label for="">Durasi Min</label>
                <input class="form-control" type="number" id="durasi_min" required>
            </div>

            <div class="form-group">
                <label for="">Durasi Max</label>
                <input class="form-control" type="number" id="durasi_max" required>
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
        <h3 class="modal-title" id="modalTitle">Tambah Ujian</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="formAddModal">

        <div class="form-group">
                <label for="">Nama Ujian</label>
                <input class="form-control" type="text" id="nama_ujian_add" required>
            </div>

            <!-- <div class="form-group">
                <label for="">Kategori Ujian</label>
                <select class="select2 form-control" id="id_kategori_add" style="width: 100%;" required>
                    <option selected="" value="" >Pilih Kategori Ujian</option>
                </select>
            </div> -->

            <!-- <div class="form-group">
                <label for="">Urutan Soal</label>
                <select class="select2 form-control" id="urutan_soal_add" style="width: 100%;">
                    <option selected="" value="" >Tipe Urutan</option>
                    <option value="urut" >Urut</option>
                    <option value="acak" >Acak</option>
                </select>
            </div>

            <div class="form-group">
                <label for="">Urutan Jawaban</label>
                <select class="select2 form-control" id="urutan_jawaban_add" style="width: 100%;">
                    <option selected="" value="" >Tipe Urutan</option>
                    <option value="urut" >Urut</option>
                    <option value="acak" >Acak</option>
                </select>
            </div> -->

            <div class="form-group">
                <label for="">Jadwal Mulai</label>
                <input class="form-control" type="text" value="<?php echo e(date('d-m-Y')); ?>" id="jadwal_mulai_add" required>
            </div>

            <div class="form-group">
                <label for="">Waktu Mulai</label>
                <input class="form-control" type="text" value="00:00" id="waktu_mulai_add" required>
            </div>

            <div class="form-group">
                <label for="">Jadwal Selesai</label>
                <input class="form-control" type="text" value="<?php echo e(date('d-m-Y')); ?>" id="jadwal_selesai_add" required>
            </div>

            <div class="form-group">
                <label for="">Waktu Selesai</label>
                <input class="form-control" type="text" value="00:00" id="waktu_selesai_add" required>
            </div>

            <div class="form-group">
                <label for="">Durasi Min</label>
                <input class="form-control" type="number" id="durasi_min_add" required>
            </div>

            <div class="form-group">
                <label for="">Durasi Max</label>
                <input class="form-control" type="number" id="durasi_max_add" required>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\cbt_online_sekolah\resources\views/admin/ujian/index.blade.php ENDPATH**/ ?>