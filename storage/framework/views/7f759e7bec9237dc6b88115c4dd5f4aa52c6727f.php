<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>CBT Online - Ujian</title>

        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
            crossorigin="anonymous"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
            integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <style>
            a {
                text-decoration: none;
            }
            .card {
                background-color: #e4f0f5;
                border: none;
            }

            .btn-action {
                padding: 0 1% 0 1%;
            }

            .list-soal {
                background-color: #6c757d; /* Warna abu-abu sekunder */
                width: 30px;
                text-align: center;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                margin-right: -3px;
            }

            .list-soal-jawab {
                background-color: #28a745; /* Warna hijau sukses */
                width: 30px;
                text-align: center;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                margin-right: -3px;
            }

            @media  only screen and (max-width: 600px) {
                .btn-kelas,
                .btn-ruang,
                footer {
                    font-size: small;
                }
                .btn-action {
                    padding: 0 2% 0 2%;
                }
            }

            .tes {width:10%; font-size:15px;}

            .radio-option {
                cursor: pointer;
            }

            img {
                max-width: 400px;
            }

        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-xxl bg-primary navbar-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#" id="nomor_soal"></a>
                <h5 id="time" style="font-size: 20px; text-align: center; margin: 0 auto; color: white;">00:00</h5>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                ></button>

                <!-- <button class="btn btn-danger rounded-pill">Logout</button> -->
                <div class="btn-group" role="group">
                    <button type="button" onclick="font_min();" class="btn btn-sm btn-warning">-</button>
                    <button type="button" onclick="reset();" class="btn btn-sm btn-danger">↻</button>
                    <button type="button" onclick="font_max();" class="btn btn-sm btn-warning">+</button>
                </div>
            </div>
        </nav>

        <!-- content -->
        <div class="container mt-3" style="margin-bottom: 100px; padding-top: 60px">
            <form action="">
                <div class="row">
                    <div class="col-md-7 col-12">

                        <div class="card">
                            <div class="card-body">
                                <h6 id="soal-container">

                                </h6>
                            </div>
                        </div>

                        <div id="jawaban-container">
                            <!-- Konten soal akan ditampilkan di sini -->
                        </div>


                    </div>


                    <div class="col-5 d-md-block d-none">
                        <div class="card">
                            <div class="card-body">
                                <h6>Daftar Soal</h6>
                                <div class="d-flex flex-wrap"  id="daftar-soal-container">

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>

        <footer
            class="bg-primary text-white text-center text-lg-start fixed-bottom d-flex justify-content-around py-2"
        >
            <div class="home">
                <div class="home text-center" id="sebelumnya-link">
                    <!-- The link will be dynamically inserted here -->
                </div>
            </div>

            <div class="search text-center">
                <a
                    href="#"
                    class="text-white d-flex flex-column align-items-center justify-content-center"
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModal"
                >
                    <i class="fa-solid fa-table mb-2"></i>
                    <span>Soal</span>
                </a>
            </div>

           <div class="profile">
                <div class="profile text-center" id="profile-link">
                    <!-- The link will be dynamically inserted here -->
                </div>
            </div>

            <input type="hidden" id="val_id_soal">

        </footer>

        <!-- Modal Soal -->
        <!-- Modal -->
        <div
            class="modal fade"
            id="exampleModal"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Daftar Soal</h1>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <div class="soal-group d-flex gap-3 flex-wrap" id="daftar-soal-container-modal">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal Soal -->

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
            integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"
            integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        ></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.all.min.js"></script>

        <script type="text/javascript">
            function preventBack() { window.history.forward(); }
            setTimeout("preventBack()", 0);
            window.onunload = function () { null };

            //disable klik kanan
            document.addEventListener('contextmenu', function (e) {
                e.preventDefault();
            });

            // Disable opening the page in a new tab or window
            window.open = function () {
                return false;
            };
        </script>

        <script>
            function simpan_jawaban(id){
                var id_jawaban_ujian = $('#val_id_soal').val();
                var id_jawaban = id;

                $.ajax({
                    url: "<?php echo e(url('siswa/ujian/simpan_jawaban')); ?>",
                    type: "POST",
                    data: {
                        '_token' : "<?php echo e(csrf_token()); ?>",
                        'id' : id_jawaban_ujian,
                        'id_jawaban' : id_jawaban,
                    },
                    success: function(response){
                        //window.location.href="<?php echo e(url('siswa/ujian_page')); ?>"+"/"+id;
                        console.log('success');
                    },
                })
            }

            function reset(){
                var id_jawaban_ujian =  $('#val_id_soal').val();
                var id_jawaban = 0;

                $.ajax({
                    url: "<?php echo e(url('siswa/ujian/reset_jawaban')); ?>",
                    type: "POST",
                    data: {
                        '_token' : "<?php echo e(csrf_token()); ?>",
                        'id' : id_jawaban_ujian,
                        'id_jawaban' : id_jawaban,
                    },
                    success: function(response){
                        console.log('success');
                        //location.reload();
                        redirectToSoalDetail(response);
                    },
                })
            }

            function font_min(){
                var fontSize = parseInt($("p").css("font-size"));
                if(fontSize != 16){
                    fontSize = fontSize - 1 + "px";
                    $("p").css({'font-size':fontSize});
                }
            }

            function font_max(){
                var fontSize = parseInt($("p").css("font-size"));
                if(fontSize != 24){
                    fontSize = fontSize + 1 + "px";
                    $("p").css({'font-size':fontSize});
                }
            }

            function selesai(){

                //window.location.href="<?php echo e(url('siswa/ujian_page')); ?>"+"/"+id;
                Swal.fire({
                    title: '<strong>Apa anda yakin ?</strong>',
                    icon: 'warning',
                    html:`Ingin menyelesaikan ujian`,
                    showCloseButton: true,
                    showCancelButton: true,
                    focusConfirm: false,
                    reverseButtons: true,
                    focusCancel: true,
                    cancelButtonText:`Batal`,
                    confirmButtonText:`Submit`
                    }).then((result) => {
                    if (result.value) {
                        var id_ujian = <?php echo json_encode($soal->id_ujian); ?>;
                        window.location.href = `<?php echo e(url('siswa/hasil_ujian')); ?>`+`/`+id_ujian;
                        //reset storage timer
                        //resetTimer();
                    }
                });

            }

            function selesai_waktu(){
                var id_ujian = <?php echo json_encode($soal->id_ujian); ?>;
                window.location.href = `<?php echo e(url('siswa/hasil_ujian')); ?>`+`/`+id_ujian;
                //reset storage timer
                resetTimer();
            }

            function resetTimer(){
                localStorage.clear("count_timer");
            }

            $(document).ready(function() {
                $('.radio-option').click(function() {
                    // Get the radio button inside the clicked div
                    var radioButton = $(this).find('input[type="radio"]');

                    // Check the radio button
                    radioButton.prop('checked', true);
                });
            });

            //alert('egreg');

            id_jawaban_siswa = <?php echo json_encode($soal->id); ?>;

            $.ajax({
                url: "<?php echo e(url('soal_detail_baru')); ?>",
                type: 'POST', // Menggunakan metode POST
                data: {
                    '_token' : "<?php echo e(csrf_token()); ?>",
                    id_jawaban_siswa: id_jawaban_siswa // Mengirimkan id sebagai data POST
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    $('#val_id_soal').val(response.soal.id);
                    // Update konten dinamis dengan data soal yang diterima
                    $('#soal-container').html(response.soal.soal);

                    $('#nomor_soal').html('Nomor : '+response.soal.nomor);

                    //list jawaban
                    $('#jawaban-container').empty();

                    // Iterasi melalui daftar soal dari respons Ajax
                    $.each(response.jawaban, function(index, data) {
                        var flagChecked = data.flag === 'true' ? 'checked' : '';

                        // Tambahkan elemen radio dan label ke dalam kontainer soal
                        var radioOption = `
                            <div class="card mt-2 radio-option" onclick="handleCardClick(${data.id});">
                                <div class="card-body d-flex" style="padding-top: 10px;">
                                    <input onclick="simpan_jawaban(${data.id});" type="radio" name="answer" id="answer_${data.id}" class="me-3" ${flagChecked}/>
                                    <label for="answer_${data.id}" style="margin-top: 14px; cursor: pointer;">${data.jawaban}</label>
                                </div>
                            </div>
                        `;

                        $('#jawaban-container').append(radioOption);
                    });

                    //list soal
                    $('#daftar-soal-container').empty();

                    // Iterasi melalui daftar soal dari respons Ajax
                    $.each(response.list_soal, function(index, data) {
                        var buttonClass = data.flag === 'false' ? 'btn-secondary' : 'btn-success';
                        var buttonBackground = data.flag === 'false' ? '' : 'background-color: #28a745;';

                        // Tambahkan elemen tombol daftar soal ke dalam kontainer daftar soal
                        var buttonElement = `
                            <button type="button" class="btn btn-sm btn-border me-1 mt-2 tes ${buttonClass}" onclick="redirectToSoalDetail(${data.id})">
                                ${data.nomor}
                            </button>
                        `;

                        $('#daftar-soal-container').append(buttonElement);
                    });

                    //modal soal
                    $('#daftar-soal-container-modal').empty();

                    // Iterasi melalui daftar soal dari respons Ajax
                    $.each(response.list_soal, function(index, data) {
                        var buttonClass = data.flag === 'false' ? 'btn-secondary' : 'btn-success';
                        var buttonBackground = data.flag === 'false' ? '' : 'background-color: #28a745;';

                        // Tambahkan tombol daftar soal ke dalam kontainer daftar soal
                        var buttonElement = `
                            <button class="btn btn-sm btn-border me-1 mt-2 tes ${buttonClass}" onclick="redirectToSoalDetail(${data.id})">
                                ${data.nomor}
                            </button>
                        `;

                        $('#daftar-soal-container-modal').append(buttonElement);
                    });

                    //kondisional button
                    if(response.soal.nomor != '1'){

                        var linkHTML = `<a href="#" onclick="soal_detail_prev(${response.soal.id})" class="text-white d-flex flex-column align-items-center justify-content-center">`;
                            linkHTML += `<i class="fa-solid fa-arrow-left mb-2"></i>`;
                            linkHTML += `<span>Sebelumnya</span>`;
                            linkHTML += `</a>`;

                    }else{
                        var linkHTML = ``;
                    }

                    $('#sebelumnya-link').html(linkHTML);

                    //jika button selesai
                    if(response.flag_selesai == 'true'){
                        var linkHTML2 = `<a href="#" onclick="selesai()" class="text-white d-flex flex-column align-items-center justify-content-center">`;
                            linkHTML2 += `<i class="fa-solid fa-arrow-right mb-2"></i>`;
                            linkHTML2 += `<span>Selesai</span>`;
                            linkHTML2 += `</a>`;
                    }else{
                        var linkHTML2 = `<a href="#" onclick="soal_detail_next(${response.soal.id})" class="text-white d-flex flex-column align-items-center justify-content-center">`;
                            linkHTML2 += `<i class="fa-solid fa-arrow-right mb-2"></i>`;
                            linkHTML2 += `<span>Selanjutnya</span>`;
                            linkHTML2 += `</a>`;
                    }

                    $('#profile-link').html(linkHTML2);

                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });

            function redirectToSoalDetail(id_jawaban_siswa){

                //alert(id_jawaban_siswa);

                $.ajax({
                    url: "<?php echo e(url('soal_detail_baru')); ?>",
                    type: 'POST', // Menggunakan metode POST
                    data: {
                        '_token' : "<?php echo e(csrf_token()); ?>",
                        id_jawaban_siswa: id_jawaban_siswa // Mengirimkan id sebagai data POST
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        $('#val_id_soal').val(response.soal.id);
                        // Update konten dinamis dengan data soal yang diterima
                        $('#soal-container').html(response.soal.soal);

                        $('#nomor_soal').html('Nomor : '+response.soal.nomor);

                        //list jawaban
                        $('#jawaban-container').empty();

                        // Iterasi melalui daftar soal dari respons Ajax
                        $.each(response.jawaban, function(index, data) {
                            var flagChecked = data.flag === 'true' ? 'checked' : '';

                            // Tambahkan elemen radio dan label ke dalam kontainer soal
                            var radioOption = `
                                <div class="card mt-2 radio-option" onclick="handleCardClick(${data.id});">
                                    <div class="card-body d-flex" style="padding-top: 10px;">
                                        <input onclick="simpan_jawaban(${data.id});" type="radio" name="answer" id="answer_${data.id}" class="me-3" ${flagChecked}/>
                                        <label for="answer_${data.id}" style="margin-top: 14px; cursor: pointer;">${data.jawaban}</label>
                                    </div>
                                </div>
                            `;

                            $('#jawaban-container').append(radioOption);
                        });

                        //list soal
                        $('#daftar-soal-container').empty();

                        // Iterasi melalui daftar soal dari respons Ajax
                        $.each(response.list_soal, function(index, data) {
                            var buttonClass = data.flag === 'false' ? 'btn-secondary' : 'btn-success';
                            var buttonBackground = data.flag === 'false' ? '' : 'background-color: #28a745;';

                            // Tambahkan elemen tombol daftar soal ke dalam kontainer daftar soal
                            var buttonElement = `
                                <button type="button" class="btn btn-sm btn-border me-1 mt-2 tes ${buttonClass}" onclick="redirectToSoalDetail(${data.id})">
                                    ${data.nomor}
                                </button>
                            `;

                            $('#daftar-soal-container').append(buttonElement);
                        });

                        //modal soal
                        $('#daftar-soal-container-modal').empty();

                        // Iterasi melalui daftar soal dari respons Ajax
                        $.each(response.list_soal, function(index, data) {
                            var buttonClass = data.flag === 'false' ? 'btn-secondary' : 'btn-success';
                            var buttonBackground = data.flag === 'false' ? '' : 'background-color: #28a745;';

                            // Tambahkan tombol daftar soal ke dalam kontainer daftar soal
                            var buttonElement = `
                                <button class="btn btn-sm btn-border me-1 mt-2 tes ${buttonClass}" onclick="redirectToSoalDetail(${data.id})">
                                    ${data.nomor}
                                </button>
                            `;

                            $('#daftar-soal-container-modal').append(buttonElement);
                        });

                        //kondisional button
                        if(response.soal.nomor != '1'){

                            var linkHTML = `<a href="#" onclick="soal_detail_prev(${response.soal.id})" class="text-white d-flex flex-column align-items-center justify-content-center">`;
                                linkHTML += `<i class="fa-solid fa-arrow-left mb-2"></i>`;
                                linkHTML += `<span>Sebelumnya</span>`;
                                linkHTML += `</a>`;

                        }else{
                            var linkHTML = ``;
                        }

                        $('#sebelumnya-link').html(linkHTML);

                        //jika button selesai
                        if(response.flag_selesai == 'true'){
                            var linkHTML2 = `<a href="#" onclick="selesai()" class="text-white d-flex flex-column align-items-center justify-content-center">`;
                                linkHTML2 += `<i class="fa-solid fa-arrow-right mb-2"></i>`;
                                linkHTML2 += `<span>Selesai</span>`;
                                linkHTML2 += `</a>`;
                        }else{
                            var linkHTML2 = `<a href="#" onclick="soal_detail_next(${response.soal.id})" class="text-white d-flex flex-column align-items-center justify-content-center">`;
                                linkHTML2 += `<i class="fa-solid fa-arrow-right mb-2"></i>`;
                                linkHTML2 += `<span>Selanjutnya</span>`;
                                linkHTML2 += `</a>`;
                        }

                        $('#profile-link').html(linkHTML2);

                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });

            }

            function soal_detail_next(id_jawaban_siswa){
                //alert(id_jawaban_siswa);
                $.ajax({
                    url: "<?php echo e(url('soal_detail_next')); ?>",
                    type: 'POST', // Menggunakan metode POST
                    data: {
                        '_token' : "<?php echo e(csrf_token()); ?>",
                        id_jawaban_siswa: id_jawaban_siswa // Mengirimkan id sebagai data POST
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        $('#val_id_soal').val(response.soal.id);
                        // Update konten dinamis dengan data soal yang diterima
                        $('#soal-container').html(response.soal.soal);

                        $('#nomor_soal').html('Nomor : '+response.soal.nomor);

                        //list jawaban
                        $('#jawaban-container').empty();

                        // Iterasi melalui daftar soal dari respons Ajax
                        $.each(response.jawaban, function(index, data) {
                            var flagChecked = data.flag === 'true' ? 'checked' : '';

                            // Tambahkan elemen radio dan label ke dalam kontainer soal
                            var radioOption = `
                                <div class="card mt-2 radio-option" onclick="handleCardClick(${data.id});">
                                    <div class="card-body d-flex" style="padding-top: 10px;">
                                        <input onclick="simpan_jawaban(${data.id});" type="radio" name="answer" id="answer_${data.id}" class="me-3" ${flagChecked}/>
                                        <label for="answer_${data.id}" style="margin-top: 14px; cursor: pointer;">${data.jawaban}</label>
                                    </div>
                                </div>
                            `;

                            $('#jawaban-container').append(radioOption);
                        });

                        //list soal
                        $('#daftar-soal-container').empty();

                        // Iterasi melalui daftar soal dari respons Ajax
                        $.each(response.list_soal, function(index, data) {
                            var buttonClass = data.flag === 'false' ? 'btn-secondary' : 'btn-success';
                            var buttonBackground = data.flag === 'false' ? '' : 'background-color: #28a745;';

                            // Tambahkan elemen tombol daftar soal ke dalam kontainer daftar soal
                            var buttonElement = `
                                <button type="button" class="btn btn-sm btn-border me-1 mt-2 tes ${buttonClass}" onclick="redirectToSoalDetail(${data.id})">
                                    ${data.nomor}
                                </button>
                            `;

                            $('#daftar-soal-container').append(buttonElement);
                        });

                        //modal soal
                        $('#daftar-soal-container-modal').empty();

                        // Iterasi melalui daftar soal dari respons Ajax
                        $.each(response.list_soal, function(index, data) {
                            var buttonClass = data.flag === 'false' ? 'btn-secondary' : 'btn-success';
                            var buttonBackground = data.flag === 'false' ? '' : 'background-color: #28a745;';

                            // Tambahkan tombol daftar soal ke dalam kontainer daftar soal
                            var buttonElement = `
                                <button class="btn btn-sm btn-border me-1 mt-2 tes ${buttonClass}" onclick="redirectToSoalDetail(${data.id})">
                                    ${data.nomor}
                                </button>
                            `;

                            $('#daftar-soal-container-modal').append(buttonElement);
                        });

                        //kondisional button
                        if(response.soal.nomor != '1'){

                            var linkHTML = `<a href="#" onclick="soal_detail_prev(${response.soal.id})" class="text-white d-flex flex-column align-items-center justify-content-center">`;
                                linkHTML += `<i class="fa-solid fa-arrow-left mb-2"></i>`;
                                linkHTML += `<span>Sebelumnya</span>`;
                                linkHTML += `</a>`;

                        }else{
                            var linkHTML = ``;
                        }

                        $('#sebelumnya-link').html(linkHTML);

                        //jika button selesai
                        if(response.flag_selesai == 'true'){
                            var linkHTML2 = `<a href="#" onclick="selesai()" class="text-white d-flex flex-column align-items-center justify-content-center">`;
                                linkHTML2 += `<i class="fa-solid fa-arrow-right mb-2"></i>`;
                                linkHTML2 += `<span>Selesai</span>`;
                                linkHTML2 += `</a>`;
                        }else{
                            var linkHTML2 = `<a href="#" onclick="soal_detail_next(${response.soal.id})" class="text-white d-flex flex-column align-items-center justify-content-center">`;
                                linkHTML2 += `<i class="fa-solid fa-arrow-right mb-2"></i>`;
                                linkHTML2 += `<span>Selanjutnya</span>`;
                                linkHTML2 += `</a>`;
                        }

                        $('#profile-link').html(linkHTML2);

                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }

            function soal_detail_prev(id_jawaban_siswa){
                //alert(id_jawaban_siswa);
                $.ajax({
                    url: "<?php echo e(url('soal_detail_prev')); ?>",
                    type: 'POST', // Menggunakan metode POST
                    data: {
                        '_token' : "<?php echo e(csrf_token()); ?>",
                        id_jawaban_siswa: id_jawaban_siswa // Mengirimkan id sebagai data POST
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        $('#val_id_soal').val(response.soal.id);
                        // Update konten dinamis dengan data soal yang diterima
                        $('#soal-container').html(response.soal.soal);

                        $('#nomor_soal').html('Nomor : '+response.soal.nomor);

                        //list jawaban
                        $('#jawaban-container').empty();

                        // Iterasi melalui daftar soal dari respons Ajax
                        $.each(response.jawaban, function(index, data) {
                            var flagChecked = data.flag === 'true' ? 'checked' : '';

                            // Tambahkan elemen radio dan label ke dalam kontainer soal
                            var radioOption = `
                                <div class="card mt-2 radio-option" onclick="handleCardClick(${data.id});">
                                    <div class="card-body d-flex" style="padding-top: 10px;">
                                        <input onclick="simpan_jawaban(${data.id});" type="radio" name="answer" id="answer_${data.id}" class="me-3" ${flagChecked}/>
                                        <label for="answer_${data.id}" style="margin-top: 14px; cursor: pointer;">${data.jawaban}</label>
                                    </div>
                                </div>
                            `;

                            $('#jawaban-container').append(radioOption);
                        });

                        //list soal
                        $('#daftar-soal-container').empty();

                        // Iterasi melalui daftar soal dari respons Ajax
                        $.each(response.list_soal, function(index, data) {
                            var buttonClass = data.flag === 'false' ? 'btn-secondary' : 'btn-success';
                            var buttonBackground = data.flag === 'false' ? '' : 'background-color: #28a745;';

                            // Tambahkan elemen tombol daftar soal ke dalam kontainer daftar soal
                            var buttonElement = `
                                <button type="button" class="btn btn-sm btn-border me-1 mt-2 tes ${buttonClass}" onclick="redirectToSoalDetail(${data.id})">
                                    ${data.nomor}
                                </button>
                            `;

                            $('#daftar-soal-container').append(buttonElement);
                        });

                        //modal soal
                        $('#daftar-soal-container-modal').empty();

                        // Iterasi melalui daftar soal dari respons Ajax
                        $.each(response.list_soal, function(index, data) {
                            var buttonClass = data.flag === 'false' ? 'btn-secondary' : 'btn-success';
                            var buttonBackground = data.flag === 'false' ? '' : 'background-color: #28a745;';

                            // Tambahkan tombol daftar soal ke dalam kontainer daftar soal
                            var buttonElement = `
                                <button class="btn btn-sm btn-border me-1 mt-2 tes ${buttonClass}" onclick="redirectToSoalDetail(${data.id})">
                                    ${data.nomor}
                                </button>
                            `;

                            $('#daftar-soal-container-modal').append(buttonElement);
                        });

                        //kondisional button
                        if(response.soal.nomor != '1'){

                            var linkHTML = `<a href="#" onclick="soal_detail_prev(${response.soal.id})" class="text-white d-flex flex-column align-items-center justify-content-center">`;
                                linkHTML += `<i class="fa-solid fa-arrow-left mb-2"></i>`;
                                linkHTML += `<span>Sebelumnya</span>`;
                                linkHTML += `</a>`;

                        }else{
                            var linkHTML = ``;
                        }

                        $('#sebelumnya-link').html(linkHTML);

                        //jika button selesai
                        if(response.flag_selesai == 'true'){
                            var linkHTML2 = `<a href="#" onclick="selesai()" class="text-white d-flex flex-column align-items-center justify-content-center">`;
                                linkHTML2 += `<i class="fa-solid fa-arrow-right mb-2"></i>`;
                                linkHTML2 += `<span>Selesai</span>`;
                                linkHTML2 += `</a>`;
                        }else{
                            var linkHTML2 = `<a href="#" onclick="soal_detail_next(${response.soal.id})" class="text-white d-flex flex-column align-items-center justify-content-center">`;
                                linkHTML2 += `<i class="fa-solid fa-arrow-right mb-2"></i>`;
                                linkHTML2 += `<span>Selanjutnya</span>`;
                                linkHTML2 += `</a>`;
                        }

                        $('#profile-link').html(linkHTML2);

                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }

            //timer dengan javascript
            let durasi_max_minutes = <?php echo json_encode($soal->durasi_max); ?>;
            let durasi_min_minutes = <?php echo json_encode($soal->durasi_min); ?>;
            let durasi_max_seconds = durasi_max_minutes * 60;
            let durasi_min_seconds = durasi_min_minutes * 60;
            let seconds = durasi_max_seconds;
            let timerInterval;

            function startTimer() {
                timerInterval = setInterval(updateTimer, 1000);
            }

            function updateTimer() {
            if (seconds <= 0) {
                clearInterval(timerInterval);
                selesai_waktu();
                //alert('Time is up!');
                // Here you can perform any actions when the timer reaches 0.
                return;
            }

            seconds--;
            const formattedTime = formatTime(seconds);
            document.getElementById('time').textContent = formattedTime;
            }

            function formatTime(totalSeconds) {
                const minutes = Math.floor(totalSeconds / 60);
                const seconds = totalSeconds % 60;
                return `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            }

            // Check if durasi_max is equal to durasi_min and show an alert
            if (durasi_max_minutes === durasi_min_minutes) {
                alert('durasi_max and durasi_min are the same in minutes!');
            }

            // Start the timer automatically when the page loads
            document.addEventListener('DOMContentLoaded', function() {
                startTimer();
            });

            //Add a function to save the timer value to the database using AJAX
            function saveToDatabase(time) {
                var id_ujian = <?php echo json_encode($soal->id_ujian); ?>;
                $.ajax({
                    url: "<?php echo e(url('update_timer')); ?>",
                    type: 'POST',
                    data: {
                        '_token' : "<?php echo e(csrf_token()); ?>",
                        time: time,
                        id_ujian: id_ujian
                    },
                    success: function(response) {
                    console.log('Time saved to the database:', response);
                    },
                    error: function(error) {
                    console.error('Error saving time to the database:', error);
                    }
                });
            }

            // Save the timer value to the database every 5 seconds (adjust as needed)
            setInterval(function() {
                saveToDatabase(seconds);
            }, 1000);

            function handleCardClick(id) {
                // Trigger the click event for the corresponding radio button
                document.getElementById(`answer_${id}`).click();

                // Optionally, you can also call your simpan_jawaban function here if needed
                simpan_jawaban(id);
            }

        </script>

        <script>
        // Cek apakah halaman dibuka di perangkat mobile
        function isMobile() {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        }

        // Variable untuk melacak apakah pengguna meninggalkan halaman
        var leftPage = sessionStorage.getItem('leftPage') === 'true';

        // Tambahkan event listener untuk event beforeunload
        window.addEventListener('beforeunload', function (event) {
            // Jika halaman dibuka di perangkat mobile dan halaman belum ditinggalkan sebelumnya
            if (isMobile() && !leftPage) {
                // Simpan informasi bahwa pengguna telah meninggalkan halaman
                sessionStorage.setItem('leftPage', 'true');
                // Tampilkan peringatan bahwa pengguna tidak boleh membuka tab baru
                alert('Anda tidak diperbolehkan membuka tab baru. Anda curang karena telah beralih dari halaman ini.');
                // Batalkan event beforeunload untuk mencegah pengguna meninggalkan halaman
                event.preventDefault();
            }
        });

        // Tambahkan event listener untuk event visibilitychange
        document.addEventListener('visibilitychange', function () {
            // Jika halaman dibuka di perangkat mobile, fokus hilang, dan halaman belum ditinggalkan sebelumnya
            if (isMobile() && document.hidden && !leftPage) {
                // Simpan informasi bahwa pengguna telah meninggalkan halaman
                sessionStorage.setItem('leftPage', 'true');
                // Tampilkan peringatan bahwa pengguna telah beralih dari halaman ini
                //alert('Anda curang karena telah beralih dari halaman ini.');
                resetUjian();
            }
        });

        // Tambahkan event listener untuk event load
        window.addEventListener('load', function () {
            // Jika halaman dibuka di perangkat mobile
            if (isMobile()) {
                // Periksa apakah pengguna telah meninggalkan halaman sebelumnya
                if (localStorage.getItem('leftPage') === 'true') {
                    // Hapus informasi bahwa pengguna telah meninggalkan halaman
                    localStorage.removeItem('leftPage');
                }
            }
        });

        function resetUjian(){

            //window.location.href="<?php echo e(url('siswa/ujian_page')); ?>"+"/"+id;
            Swal.fire({
                title: '<strong>Anda terkonfirmasi keluar dari halaman !</strong>',
                icon: 'warning',
                html:`Ujian akan direset ulang`,
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                reverseButtons: true,
                focusCancel: true,
                confirmButtonText:`Submit`
                }).then((result) => {
                if (result.value) {
                    var id_ujian = <?php echo json_encode($soal->id_ujian); ?>;
                    window.location.href = `<?php echo e(url('siswa/reset_ujian')); ?>`+`/`+id_ujian;
                    //reset storage timer
                    //resetTimer();
                }
            });

        }
    </script>

    </body>
</html>
<?php /**PATH C:\composer\cbt_online_sekolah\resources\views/siswa/soal.blade.php ENDPATH**/ ?>