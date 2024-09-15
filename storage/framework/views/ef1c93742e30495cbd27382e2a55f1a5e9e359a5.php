

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

            <?php if($count_soal > 0): ?>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="<?php echo e(url('/ujian/tambah/list_siswa', $ujian->id)); ?>"  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" >
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Peserta Ujian</a>
                
                <a href="<?php echo e(url('/ujian/export_hasil_siswa', $ujian->id)); ?>"  class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm" >
                <i class="fas fa-file fa-sm text-white-50"></i> Export Nilai Ujian</a>
            </div>
            <p></p><p></p>
            <?php endif; ?>

            <!-- Page Heading -->
            <!-- <h1 class="h3 mb-2 text-gray-800">Siswa</h1> -->

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Peserta Ujian -> <?php echo e($ujian->nama_ujian); ?></h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Nilai</th>
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

            var id = <?php echo json_encode($ujian->id); ?>;
            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "<?php echo e(url('ujian/api/list_siswa')); ?>/"+id,
                columns: [
                    {data: 'DT_RowIndex',searchable: false},
                    {data: 'nama_siswa', name: 'nama_siswa'},
                    {data: 'nama_kelas', name: 'nama_kelas'},
                    {data: 'nilai', name: 'nilai'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            $(".select2").select2();

            $("#datepicker").datepicker( {
                format: " yyyy", // Notice the Extra space at the beginning
                viewMode: "years", 
                minViewMode: "years"
            });

        });

        $(document).ready(function(){

            //get siswa dari kelas
            $('#id_kelas_add').on('change', function() {
                var id = this.value;
                //alert(id);

                $.ajax({
                    url: "<?php echo e(url('ujian/kelas/list_siswa')); ?>/"+id,
                    method : "get",
                    success : function(sup){
                        $('#id_siswa_add').children('option:not(:first)').remove().end();

                        $.each(sup,function(index,soObj){
                            $('#id_siswa_add').append('<option value="'+soObj.id+'"> '+soObj.name+' </option>')
                        });

                    },
                });

            });

        });

        $('#formAddModal').on('submit', function(e){
            e.preventDefault();
            var id_kelas = $('#id_kelas_add').val();
            var id_siswa = $('#id_siswa_add').val();
            var id_ujian = <?php echo json_encode($ujian->id); ?>;
            
            $.ajax({
                url: "<?php echo e(url('ujian/simpan/list_siswa')); ?>",
                type: "POST",
                data: {
                    '_token' : "<?php echo e(csrf_token()); ?>",
                    'id_kelas' : id_kelas,
                    'id_siswa' : id_siswa,
                    'id_ujian' : id_ujian,
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
                            url: "<?php echo e(url('ujian/delete/list_siswa')); ?>"+"/"+id,
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
            $('#id_kelas_add').val('');
            $('#id_siswa_add').val('');
        }

        function show_nilai(id){
            $.ajax({
                url: "<?php echo e(url('ujian/show_nilai')); ?>"+"/"+id,
                type: "GET",
                dataType: "json",
                success: function(response) {
                    // Menghapus semua baris yang ada di dalam tabel
                    $('#nilai-table tbody').empty();

                    // Melooping data dan menambahkan baris ke dalam tabel
                    $.each(response, function(index, nilai) {
                        var newRow = "<tr>" +
                            "<td>" + nilai.nama_bank_soal + "</td>" +
                            "<td>" + nilai.total_nilai + "</td>" +
                            // Tambahkan kolom lain sesuai dengan struktur tabel Nilai
                            "</tr>";
                            
                        $('#nilai-table tbody').append(newRow);
                    });
                    
                    // Menghitung total nilai setelah melooping
                    var totalNilai = response.reduce(function(total, nilai) {
                        return total + parseFloat(nilai.total_nilai);
                    }, 0);
                    
                    // Menambahkan baris total nilai di bawah tabel
                    var totalRow = "<tr>" +
                        "<td><strong>Total Nilai</strong></td>" +
                        "<td><strong>" + totalNilai + "</strong></td>" +
                        "</tr>";
                        
                    $('#nilai-table tbody').append(totalRow);

                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });

            $('#nilaiModal').modal('show');
        }

    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>
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
        <form action="" id="formAddModal">

            <div class="form-group">
                <label for="">Kelas</label>
                <select class="select2 form-control" id="id_kelas_add" style="width: 100%;" required>
                    <option selected="" value="" >Pilih Kelas</option>
                    <?php $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($k->id); ?>" ><?php echo e($k->nama_kelas); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group">
                <label for="">Siswa</label>
                <select class="select2 form-control" id="id_siswa_add" style="width: 100%;" required>
                    <option selected="" value="all" >Semua Siswa</option>
                </select>
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

<div class="modal fade" id="nilaiModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modalTitle">Rincian Nilai</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <table class="table table-bordered" id="nilai-table">
            <thead>
                <tr>
                    <th>Nama Bank Soal</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\cbt_online_sekolah\resources\views/admin/ujian/list_siswa.blade.php ENDPATH**/ ?>