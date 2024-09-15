<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CBT Online - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo e(url('sbadmin/vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo e(url('sbadmin/css/sb-admin-2.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(url('sbadmin/vendor/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.css" integrity="sha512-BB0bszal4NXOgRP9MYCyVA0NNK2k1Rhr+8klY17rj4OhwTmqdPUQibKUDeHesYtXl7Ma2+tqC6c7FzYuHhw94g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <?php echo $__env->yieldContent('style'); ?>
    <?php $__env->startSection('css'); ?>
    <?php echo $__env->yieldSection(); ?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
            <?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->yieldContent('content'); ?>
            </div>
            <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <!-- End of Content Wrapper -->
        <?php echo $__env->yieldContent('modal'); ?>
    </div>
    <!-- End of Page Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo e(url('sbadmin/vendor/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(url('sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo e(url('sbadmin/vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo e(url('sbadmin/js/sb-admin-2.min.js')); ?>"></script>

    <!-- Page level plugins -->
    <script src="<?php echo e(url('sbadmin/vendor/chart.js/Chart.min.js')); ?>"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo e(url('sbadmin/js/demo/chart-area-demo.js')); ?>"></script>
    <script src="<?php echo e(url('sbadmin/js/demo/chart-pie-demo.js')); ?>"></script>

    <!-- Page level plugins -->
    <script src="<?php echo e(url('sbadmin/vendor/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(url('sbadmin/vendor/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
    <!-- Page level custom scripts -->
    <script src="<?php echo e(url('sbadmin/js/demo/datatables-demo.js')); ?>"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/clockpicker/0.0.7/bootstrap-clockpicker.js" integrity="sha512-1QoWYDbO//G0JPa2VnQ3WrXtcgOGGCtdpt5y9riMW4NCCRBKQ4bs/XSKJAUSLIIcHmvUdKCXmQGxh37CQ8rtZQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        // Fungsi untuk mengupdate tanggal dan jam secara real-time
        function updateDateTime() {
            var datetimeElement = document.getElementById("datetime");
            var currentDate = new Date();
            var options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric' };
            var formattedDateTime = currentDate.toLocaleDateString('id-ID', options);

            // Ubah keterangan pukul menjadi Jam
            formattedDateTime = formattedDateTime.replace("pukul", "Jam");

            // Ubah separator waktu menjadi titik dua (:)
            formattedDateTime = formattedDateTime.replace(".", ":");

            datetimeElement.innerHTML = formattedDateTime;
        }

        // Panggil fungsi updateDateTime setiap detik
        setInterval(updateDateTime, 10);
    </script>

    <?php $__env->startSection('js'); ?>
    <?php echo $__env->yieldSection(); ?>
    <?php echo $__env->yieldContent('script'); ?>
</body>

</html><?php /**PATH C:\xampp\htdocs\cbt_online_sekolah\resources\views/layouts/app.blade.php ENDPATH**/ ?>