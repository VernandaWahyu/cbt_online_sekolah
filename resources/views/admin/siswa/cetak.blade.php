<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Cetak ID Card</title>
        <style>
            body {
                font-family: sans-serif;
            }
            .container {
                display: flex;
                flex-wrap: wrap;
            }
            .kartu {
                height: 60mm;
                width: 100mm;
                /* background-image: url('https://img.freepik.com/free-vector/blue-curve-background_53876-113112.jpg?w=2000'); */
                /* background: linear-gradient(to bottom, #1795ee, #ffffff); */
                border: 2px solid #1795ee;
                margin-right: 10px;
                margin-bottom: 10px;
            }
            .title {
                text-align: center;
            }
            .content {
                display: flex;
                justify-content: space-around;
                align-items: center;
            }
            .picture img {
                border-radius: 50%;
            }
            td {
                font-size: 14px; /* Ubah ukuran font sesuai kebutuhan */
            }
        </style>
    </head>
    <body>
        <div>
            <input type="text" id="inputWidth" placeholder="Width (e.g., 100mm)" />
            <input type="text" id="inputHeight" placeholder="Height (e.g., 60mm)" />
            <button onclick="changeSize()">Apply</button>
            <input type="button" onclick="printDiv('printableArea')" value="Print" />
        </div>
        <br>

        <div class="container" id="printableArea">
            @foreach($siswa as $index => $data)
            <div class="kartu" id="kartu{{ $index }}"> <!-- Tambahkan ID dengan nomor indeks -->
                <h2 class="title" style="color:grey;">CBT Online</h2>
                <div class="content">
                    <div class="picture">
                        @if($data->avatar && file_exists(public_path('storage/images/'.$data->avatar)))
                            <img src="{{ asset('/storage/images/'.$data->avatar) }}" width="100" />
                        @else
                            <img src="{{url('sbadmin/img/avatar.png')}}" width="100" />
                        @endif
                    </div>

                    <div class="bio">
                        <table>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{ $data->name }}</td>
                            </tr>
                            <tr>
                                <td>Kelas</td>
                                <td>:</td>
                                <td>{{ $data->nama_kelas }}</td>
                            </tr>
                            <tr>
                                <td>Program</td>
                                <td>:</td>
                                <td>{{ $data->nama_program }}</td>
                            </tr>
                            <tr>
                                <td>No. Siswa</td>
                                <td>:</td>
                                <td>{{ $data->no_siswa }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <script>
            function changeSize() {
                var inputWidth = document.getElementById("inputWidth").value;
                var inputHeight = document.getElementById("inputHeight").value;
                var kartuElements = document.getElementsByClassName("kartu"); // Mengambil semua elemen kartu
                for (var i = 0; i < kartuElements.length; i++) {
                    kartuElements[i].style.width = inputWidth;
                    kartuElements[i].style.height = inputHeight;
                }
            }

            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;
            }
        </script>
    </body>
</html>
