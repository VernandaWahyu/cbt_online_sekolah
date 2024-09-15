<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>CBT Online - Konfirmasi Ujian</title>
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

            @media  only screen and (max-width: 600px) {
                .btn-kelas,
                .btn-ruang,
                footer {
                    font-size: small;
                }
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }

            td, th {
                /* border: 1px solid #00050a; */
                padding: 8px;
            }

            @keyframes  shimmer {
                0% {
                    background-position: -1000px;
                }
                100% {
                    background-position: 1000px;
                }
            }

            @keyframes  fadeIn {
                0% {
                    opacity: 0;
                }
                100% {
                    opacity: 1;
                }
            }

            .shimmer {
                background: linear-gradient(270deg, #ffffff, #f3f3f3, #ffffff);
                background-size: 1000px 100%;
                animation: shimmer 2.0s infinite linear;
            }

            .fadeIn {
                animation: fadeIn 2.0s ease-in-out infinite;
            }

        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-xxl bg-primary navbar-dark">
            <div class="container">
                <a class="navbar-brand fadeIn shimmer" href="#">
                    <img src="<?php echo e(url('cbt_logo.png')); ?>" alt="Logo" height="40">
                </a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                ></button>

                <a href="<?php echo e(url('/logout')); ?>" class="btn btn-sm btn-danger rounded-pill">Logout</a>
            </div>
        </nav>

        <!-- content -->
        <div class="container mt-3 col-lg-8" style="margin-bottom: 150px">
            <div class="row mt-3">
                <div class="col">

                    <a href="#" class="text-dark">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <center><h5>Detail Ujian</h5></center>
                                <br>
                                <table>
                                    <tr>
                                        <td>Nama Ujian</td>
                                        <td style="text-align: right;">
                                            <span class="badge rounded-pill bg-primary"><?php echo e($ujian->nama_ujian); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Waktu Ujian</td>
                                        <td style="text-align: right;">
                                            <span class="badge rounded-pill bg-success"><?php echo e($ujian->durasi_max); ?> Menit</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah</td>
                                        <td style="text-align: right;">
                                            <span class="badge rounded-pill bg-danger"><?php echo e($sum_soal); ?> Soal</span>
                                        </td>
                                    </tr>
                                </table>
                                <p></p>
                                <center>
                                    <a href="<?php echo e(url('/soal', $ujian->id_ujian_siswa)); ?>" class="btn btn-warning w-50 mt-2">Mulai Ujian</a>
                                </center>
                            </div>
                        </div>
                    </a>

                </div>
            </div>
        </div>

        <footer
            class="bg-primary text-white text-center text-lg-start fixed-bottom d-flex justify-content-around py-2"
        >
            <div class="home">
                <div class="home text-center">
                    <a
                        href="<?php echo e(url('home')); ?>"
                        class="text-white d-flex flex-column align-items-center justify-content-center"
                    >
                        <i class="fa-solid fa-home mb-2"></i>
                        <span>Home</span>
                    </a>
                </div>
            </div>
            <div class="search text-center">
                <a
                    href="<?php echo e(url('list')); ?>"
                    class="text-white d-flex flex-column align-items-center justify-content-center"
                >
                    <i class="fa-solid fa-calendar mb-2"></i>
                    <span>Ujian</span>
                </a>
            </div>

            <div class="profile">
                <div class="profile text-center">
                    <a
                        href="<?php echo e(url('profile')); ?>"
                        class="text-white d-flex flex-column align-items-center justify-content-center"
                    >
                        <i class="fa-solid fa-user mb-2"></i>
                        <span>Profile</span>
                    </a>
                </div>
            </div>
        </footer>

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

        <script type="text/javascript">
            function preventBack() { window.history.forward(); }
            setTimeout("preventBack()", 0);
            window.onunload = function () { null };
        </script>

    </body>
</html>
<?php /**PATH C:\xampp\htdocs\cbt_online_sekolah\resources\views/siswa/confirm.blade.php ENDPATH**/ ?>