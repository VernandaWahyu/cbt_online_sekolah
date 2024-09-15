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
    <td>Tanggal Export : {{ date('d-m-Y H:i:s') }}</td>
  </tr>
</table>

<table>
  <tr>
    <th>Nama Siswa </th>
    <th>Kelas </th>
    <th>Nilai </th>
  </tr>
  
  @foreach($data as $d)
  <tr>
    <td>{{ $d->nama_siswa }}</td>
    <td>{{ $d->nama_kelas }}</td>
    <td>{{ $d->nilai }}</td>
  </tr>
  @endforeach

</table>

</body>
</html>

