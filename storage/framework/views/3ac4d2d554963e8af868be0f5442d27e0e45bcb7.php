<!DOCTYPE html>
<html>
<head>
<style>
td, th {
  border: 1px solid #000802;
}

</style>
</head>
<body>

<table>
  <tr>
    <th>Report Hasil Ujian Siswa</th>
  </tr>
  <tr>
    <td>Tanggal Export : <?php echo e(date('d-m-Y H:i:s')); ?></td>
  </tr>
</table>

<table>
  <tr>
    <th>Nama Siswa </th>
    <th>Kelas </th>
    <th>Nilai </th>
  </tr>
  
  <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <tr>
    <td><?php echo e($d->nama_siswa); ?></td>
    <td><?php echo e($d->nama_kelas); ?></td>
    <td><?php echo e($d->nilai); ?></td>
  </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</table>

</body>
</html>

<?php /**PATH C:\xampp\htdocs\cbt_online_sekolah\resources\views/admin/ujian/report_ujian_siswa.blade.php ENDPATH**/ ?>