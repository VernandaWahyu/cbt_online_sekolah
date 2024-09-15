<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Soal</title>
</head>
<body>
    <center><h2><?php echo e($nama_bank_soal); ?></h2></center>
    <?php $no = 1; ?>
    <?php $__currentLoopData = $soal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $raw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <!-- <p><span><?php echo e($no++); ?>.</span> <?php echo $raw->soal; ?></p> -->
        <table>
            <tr>
                <td><?php echo e($loop->iteration); ?>.</td>
                <td><?php echo $raw->soal; ?></td>
            </tr>
        </table>
        <?php 
            $jawaban = DB::table('jawaban')->where('id_soal', $raw->id)->orderBy('no_jawaban','asc')->get();

            foreach($jawaban as $j){
                if($j->no_jawaban == '1'){
                    $abjad = 'a';
                }elseif($j->no_jawaban == '2'){
                    $abjad = 'b';
                }elseif($j->no_jawaban == '3'){
                    $abjad = 'c';
                }elseif($j->no_jawaban == '4'){
                    $abjad = 'd';
                }elseif($j->no_jawaban == '5'){
                    $abjad = 'e';
                }

                $j->abjad = $abjad;
            }
        ?>
        <?php $__currentLoopData = $jawaban; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $max = DB::table('jawaban')->where('id_soal', $data->id_soal)->orderBy('nilai_jawaban','desc')->first();
        ?>
        <table style="margin-top: -30px;">
            <tr>
                <td><?php echo e($data->abjad); ?>.</td>
                <td><?php echo $data->jawaban; ?></td>
            </tr>
        </table>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if($opsi == 'jawaban'): ?>
        <table style="margin-top: -30px;">
            <tr>
                <td>Jawaban :</td>
                <td><?php echo $max->jawaban; ?></td>
            </tr>
        </table>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\cbt_online_sekolah\resources\views/admin/bank_soal/soal_print.blade.php ENDPATH**/ ?>