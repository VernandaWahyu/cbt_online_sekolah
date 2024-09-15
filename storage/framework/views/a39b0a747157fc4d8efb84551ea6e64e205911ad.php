

<?php $__env->startSection('list-bank-soal','active'); ?>
<?php $__env->startSection('list-bank-soal','active'); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<style>
#fieldGroupTemplate {
  display: none;
}

#fieldLabelTemplate {
  display: none;
}

img {
    width: 150px;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php if(session('success')): ?>
        <script>
            Swal.fire({
                position: "center",
                title: "Sukses!",
                text: "<?php echo e(session('success')); ?>",
                icon: "success",
                showConfirmButton: false,
                timer: 1000
            });
        </script>
    <?php elseif(session('failed')): ?>
        <script>
            Swal.fire({
                position: "center",
                title: "Gagal!",
                text: "<?php echo e(session('failed')); ?>",
                icon: "error",
                showConfirmButton: false,
                timer: 1000
            });
        </script>
    <?php endif; ?>

    <!-- Main content -->
    <section class="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="/bank_soal/soal/tambah?bank_soal_id=<?php echo e($bank_soal->id); ?>"  class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" >
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Soal</a>
                
                <!-- <a href="<?php echo e(url('bank_soal/soal/report', $bank_soal->id)); ?>"  class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm" >
                <i class="fas fa-file fa-sm text-white-50"></i> Preview Soal</a> -->

                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm" data-toggle="modal" data-target="#previewModal">
                <i class="fas fa-file fa-sm text-white-50"></i> Preview Soal
                </button>

                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#importModal">
                <i class="fas fa-upload fa-sm text-white-50"></i> Import Soal
                </button>

                <a href="<?php echo e(url('bank_soal/soal/backup', $bank_soal->id)); ?>"  class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" >
                <i class="fas fa-download fa-sm text-white-50"></i> Backup Soal</a>

                <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#uploadModal">
                <i class="fas fa-upload fa-sm text-white-50"></i> Restore Soal
                </button>

            </div>
            <p></p><p></p>

            <!-- Page Heading -->
            <!-- <h1 class="h3 mb-2 text-gray-800">Siswa</h1> -->

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Soal <?php echo e($bank_soal->nama_bank_soal); ?></h6>
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

    <!-- Modal -->
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Import Soal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <form action="<?php echo e(url('bank_soal/soal/import', $bank_soal->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="file" class="col-form-label">File Word Soal</label>
                <input type="file" name="file" class="form-control">
                <p></p>
                <a href="<?php echo e(url('Contoh Soal.docx')); ?>">Contoh Template Word Soal</a>
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

    <!-- Modal -->
    <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Preview Soal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <form action="<?php echo e(url('bank_soal/soal/report', $bank_soal->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label for="">Opsi Cetak</label>
                <select class="form-control" name="opsi" id="opsi" style="width: 100%;" required>
                    <option value="jawaban" >dengan jawaban</option>
                    <option value="tanpa" >tanpa jawaban</option>
                </select>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Cetak</button>
        </div>
        </form>
        </div>
    </div>
    </div>
    
      <!-- Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Upload Soal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <form action="<?php echo e(url('bank_soal/soal/upload', $bank_soal->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="file" class="col-form-label">File Upload</label>
                <input type="file" name="file" class="form-control">
                <input type="hidden" name="id_bank_soal" value="<?php echo e($bank_soal->id); ?>">
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

<?php $__env->startSection('js'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.11.3/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.11.3/adapters/jquery.js"></script>

    <script>

        $(document).ready(function(){
            
            // Data Tables 
            var bank_soal_id = "<?php echo e($bank_soal->id); ?>"
            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                          url:"<?php echo url('/bank_soal/detail'); ?>",
                          data: function (i) {
                                  i.bank_soal_id = bank_soal_id;
                                },
                      },
                columns: [
                    {data: 'DT_RowIndex',orderable: false, searchable: false},
                    {data: 'soal', name: 'id_soal'},
                    
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
             //section add limit
            var maxGroup = 4;

            // initialize all current editor(s)
            $('.editor').ckeditor();

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
                $fieldHTML.find('textarea').ckeditor();

            } else {
                alert('Maximum ' + maxGroup + ' sections are allowed.');
            }

            });

            //remove fields 
            $("body").on("click", ".remove", function() {
                $(this).parents(".fieldGroup").remove();
            });
        });

        function tambah(id){
                $('#addModal').modal('show');
                // $('input[name="soal_id"]').val('');
                // $('input[name="nilai"]').empty();
                // $('input[name="jawaban"]').empty();
                
                // var editor = $('.editor').ckeditor().editor;

                //     // Menambahkan nilai ke editor CKEditor menggunakan setData()
                //     editor.setData("");
            }
        $('#formAddModal').submit(function(e){
            e.preventDefault();
            var formdata = $('#formAddModal').serialize();
            $.ajax({
                data:formdata,
                method:"post",
                url:"<?php echo e(route('soal-store')); ?>",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(response){
                $('#addModal').modal('hide');

                    if(response.status == "success"){
                        Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000
                        }).then(function() {
                            // refresh table
                            location.reload();
                        });

                    }
                },
                error:function(error){
                    if(error.status == 422){
                            if(error.responseJSON.errors.soal) {
                            //show alert
                            $('#alert-soal').removeClass('d-none');
                            $('#alert-soal').addClass('d-block');
                            //add message to alert
                            $('#alert-soal').html(error.responseJSON.errors.soal[0]);
                            }else{
                                $('#alert-soal').removeClass('d-block');
                                $('#alert-soal').addClass('d-none');
                            }
                        }
                }
            })
        })

        // function edit(id){

        //     $.ajax({
        //         url : "<?= url('bank_soal/soal/edit') ?>",
        //         data:{
        //             'id':id
        //         },
        //         method : "get",
        //         success : function(response){
        //             console.log(response)
        //             $('input[name="soal_id"]').val(response.soal.id)
        //             var editor = $('#soal_edit').ckeditor().editor;

        //             editor.setData(response.soal.soal);

        //             $.each(response.jawaban, function (key, value) {
        //                 // .trigger('change')
            
        //                 var html = '';
        //                 $('#newUpdateRow').empty();

        //                 if(key == 0){


        //                     html += `<label for="">Nilai</label>
        //                             <div class="row fieldGroup">

        //                                 <div class="col-md-8">
        //                                     <div class="form-group">
        //                                     <input type="text" required name="nilai[]" id="nilai${key}" class="form-control" value="${value.nilai_jawaban}">
        //                                     </div>
        //                                 </div>
                                        
        //                                 <div class="col-md-4  ">
        //                                     <a href="javascript:void(0)" class="btn btn-success addMore">
        //                                     <span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Tambahkan Jawaban
        //                                     </a>
        //                                 </div>

        //                                 <div class="col-md-12  ">
        //                                     <div class="form-group">
        //                                     <label for="">Jawaban</label>
        //                                     <textarea name="jawaban[${key}]" id="jawaban${key}" required class="editor"></textarea>
        //                                     </div>
        //                                 </div>
        //                             </div>`;
        //                     $('#newUpdateRow').append(html);
        //                     var jawaban = $(`#jawaban0`).ckeditor().editor;

        //                     jawaban.setData(value.jawaban);

        //                 }else{


        //                     html += `<div class="d-flex mt-2" id="inputFormRow">
        //                                             <select name="sdm_komponen_gaji_edit[${key}]" class="form-control"></select>
                        
        //                                             <div class="mx-2 my-1">
        //                                                 <button id="removeRow" type="button" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i></button>
        //                                             </div>
        //                                             </div>`;
        //                     $('#newUpdateRow').append(html);
        //                 }
        //             });

        //             $('#editModal').modal('show');

                   

        //         },
        //     });
        // }

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
                            url: "<?php echo e(url('bank_soal/soal/delete')); ?>"+"/"+id,
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
        <?php if(session()->has('success')): ?>
        Swal.fire({
                position: "center",
                title: "<?php echo e(session('success')); ?>",
                icon: "success",
                showConfirmButton: false,
                timer: 1000
            });
        <?php endif; ?>
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modal'); ?>


<div class="modal fade" id="addModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modalTitle">Tambah Soal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="formAddModal">

        <div class="form-group">
            <label for="">Soal</label>
            <textarea name="soal" id="soal" class="editor"></textarea>
            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-soal">

            </div>

            <input type="hidden" value=" <?php echo e($bank_soal->id); ?>" name="bank_soal_id">
            <input type="hidden" value="" name="soal_id">
        </div>

        <hr>

        <label for="">Nilai</label>
        <div class="row fieldGroup">

            <div class="col-md-8">
                <div class="form-group">
                <input type="text" required name="nilai[]" id="sectionTitle" class="form-control">
                </div>
            </div>
            
            <div class="col-md-4  ">
                <a href="javascript:void(0)" class="btn btn-success addMore">
                <span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span> Tambahkan Jawaban
                </a>
            </div>

            <div class="col-md-12  ">
                <div class="form-group">
                <label for="">Jawaban</label>
                <textarea name="jawaban[]" required class="editor"></textarea>
                </div>
            </div>
        </div>

        <div id="newRow">
                           
        </div>

        <label for="" id="fieldLabelTemplate">Nilai</label>
        <div class="row" id="fieldGroupTemplate">

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
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="modalTitle">Edit Soal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" id="formEditModal">
  
          <div class="form-group">
              <label for="">Soal</label>
              <textarea name="soal" id="soal_edit" class="editor"></textarea>
              <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-soal-edit">
  
              </div>
  
              <input type="hidden" value=" <?php echo e($bank_soal->id); ?>" name="bank_soal_id">
              <input type="hidden" value="" name="soal_id">
          </div>
  
          <hr>
          <div id="newUpdateRow">
                 
          </div>

          <label for="" id="fieldLabelTemplate">Nilai</label>
        <div class="row" id="fieldGroupTemplate">

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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\cbt_online_sekolah\resources\views/admin/bank_soal/soal.blade.php ENDPATH**/ ?>