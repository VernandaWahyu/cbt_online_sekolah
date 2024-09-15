

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

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Peserta Ujian -> <?php echo e($ujian->nama_ujian); ?></h6>
                </div>

                <form role="form" method="POST" action="<?php echo e(url('/ujian/simpan/list_siswa')); ?>">
				        <?php echo e(csrf_field()); ?>

                <div class="card-body">

                  <input type="hidden" name="id_ujian" id="id_ujian" value="<?php echo e($id); ?>">

                  <!-- <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="tambah()">
                  <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Kelas</button> -->

                  <div class="form-row">

                    <div class="form-group col-md-3">
                          <select class="form-control select2" id="kelas">
                              <label for="">Kelas</label>
                              <option selected value="">Pilih Kelas</option>
                              <?php $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($k->id); ?>"><?php echo e($k->nama_kelas); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                    </div>

                    <div class="form-group col-md-4">
                          <button type="button" id="tampil_siswa" class="btn btn-sm btn-primary">Tampilkan Data Siswa</button>
                    </div>

                  </div>

                  <p></p>

                    <div class="row">
                      <div class="col-md-12">
                        <div style="overflow:scroll; max-height:500px; font-size: 14px;">
                          <table class="table table-inverse">
                            <thead>
                              <tr>
                                <th width="8%"><input type="checkbox" id="checkAll">&nbsp;&nbsp;<input type="button" id="btn-checked" class="btn btn-sm btn-danger" value="Hapus" style="padding:0% 5%"></th>
                                <!-- <th style="font-size:16px;" width="10%">No</th> -->
                                <th style="font-size:16px;" width="50%">Nama Siswa</th>
                                <th style="font-size:16px;" width="20%">Kelas</th>
                                <th style="font-size:16px; text-align:left" width="10%">Opsi</th>
                              </tr>
                            </thead>

                            <tbody id="row">

                            </tbody>

                          </table>
                        </div>
                        
                      </div>
                    </div>

                    <div class="box-footer">
                      <div class="pull-left">
                        <button type="submit" class="btn btn-success">Simpan</button>
                      </div>
                    </div>

                </div>
                </form>

            </div>

        </div>
        <!-- /.container-fluid -->

    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.all.min.js"></script>
    <script>
      var tampung = [];
      var produk = [];
      var lengthDataProduk;

        $(function () {
          $(".select2").select2();

          $('#tampil_siswa').on('click',function(){

            // var bank_soal = $(this).val();
            var lengthProduk = produk.length;
            var token = "<?= csrf_token()?>";
            var id_ujian = $("#id_ujian").val();
            var kelas = $("#kelas").val();
            // var acak = $("#acak").val();

            if( $(this).val() != null ){
              $.ajax({
                url: "<?= url('ujian/get_list_siswa') ?>",
                method: "post",
                data: {
                  _token: token,
                  length : lengthProduk,
                //   bank_soal : bank_soal,
                    id_ujian : id_ujian,
                    kelas : kelas,
                //   acak : acak,
                },
                success: function (s) {
                  $("#row").empty();
                  $('#row').append(s.data_row);
                  produk = s.arr_id;
                }
              });
            }

            $('#bank_soal option:selected').remove();

          });

          //multiple delete row
          $('#btn-checked').on('click', function() {
              $('td input:checked').closest('tr').remove();
          });

          $("#checkAll").click(function () {
              $('input:checkbox').not(this).prop('checked', this.checked);
          });

        });

    function hapusBaris(id)
	{
        if (confirm('Apakah anda yakin menghapus data ?')) {
            $('#tr_'+id).remove();
        }
	}

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\composer\cbt_online_sekolah\resources\views/admin/ujian/tambah_list_siswa.blade.php ENDPATH**/ ?>