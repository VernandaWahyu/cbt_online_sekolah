<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Soal</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <style>
        @media  print {
        body {
            visibility: hidden;
        }
        #section-to-print {
            visibility: visible;
            position: absolute;
            left: 0;
            top: 0;
        }
        }

        .label-container{
            position:fixed;
            bottom:48px;
            right:105px;
            display:table;
            visibility: hidden;
        }

        .label-text{
            color:#FFF;
            background:rgba(51,51,51,0.5);
            display:table-cell;
            vertical-align:middle;
            padding:10px;
            border-radius:3px;
        }

        .label-arrow{
            display:table-cell;
            vertical-align:middle;
            color:#333;
            opacity:0.5;
        }

        .float{
            position:fixed;
            width:60px;
            height:60px;
            bottom:40px;
            right:40px;
            background-color:#F33;
            color:#FFF;
            border-radius:50px;
            text-align:center;
            box-shadow: 2px 2px 3px #999;
            z-index:1000;
            animation: bot-to-top 2s ease-out;
        }

        ul{
            position:fixed;
            right:40px;
            padding-bottom:20px;
            bottom:80px;
            z-index:100;
        }

        ul li{
            list-style:none;
            margin-bottom:10px;
        }

        ul li a{
            background-color:#F33;
            color:#FFF;
            border-radius:50px;
            text-align:center;
            box-shadow: 2px 2px 3px #999;
            width:60px;
            height:60px;
            display:block;
        }

        ul:hover{
            visibility:visible!important;
            opacity:1!important;
        }


        .my-float{
            font-size:24px;
            margin-top:18px;
        }

        a#menu-share + ul{
        visibility: hidden;
        }

        a#menu-share:hover + ul{
        visibility: visible;
        animation: scale-in 0.5s;
        }

        a#menu-share i{
            animation: rotate-in 0.5s;
        }

        a#menu-share:hover > i{
            animation: rotate-out 0.5s;
        }

        @keyframes  bot-to-top {
            0%   {bottom:-40px}
            50%  {bottom:40px}
        }

        @keyframes  scale-in {
            from {transform: scale(0);opacity: 0;}
            to {transform: scale(1);opacity: 1;}
        }

        @keyframes  rotate-in {
            from {transform: rotate(0deg);}
            to {transform: rotate(360deg);}
        }

        @keyframes  rotate-out {
            from {transform: rotate(360deg);}
            to {transform: rotate(0deg);}
        }

        img {
            width: 300px;
            margin-left:-25px;
        }

        .soal_spasi p {
            padding-left:12px;
        }

        .jawaban p {
            padding-left:5px;
        }

        .abjad {
            padding-left:26px;
        }
    </style>
</head>
<body>
    <a href="<?php echo e(url('bank_soal/soal/print/'.$id.'/'.$opsi)); ?>" class="float" id="menu-share">
    <i class="fa fa-file my-float"></i>
    </a>

    <div id="section-to-print">
        <center><h2><?php echo e($nama_bank_soal); ?></h2></center>
        <?php $no = 1; ?>
        <?php $__currentLoopData = $soal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $raw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <!-- <p><span><?php echo e($no++); ?>.</span> <?php echo $raw->soal; ?></p> -->
            <!-- <h5 style="margin-bottom:-10px; margin-right:-10px;"><?php echo e($loop->iteration); ?>.</h5> -->
            <table>
                <tr>
                    <td style="vertical-align:top; padding-top:17px;"><?php echo e($loop->iteration); ?>.</td>
                    <td class="soal_spasi"><?php echo $raw->soal; ?></td>
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
                    <td class="abjad"><?php echo e($data->abjad); ?>.</td>
                    <td class="jawaban"><?php echo $data->jawaban; ?></td>
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
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\cbt_online_sekolah\resources\views/admin/bank_soal/soal_report.blade.php ENDPATH**/ ?>