<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>CBT Online - Daftar Ujian</title>

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

            .rounded-pill {
                border-radius: 50px;
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

                    <div id="ujian-list">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Cari Ujian..." aria-label="Cari" aria-describedby="button-addon2" id="search-input">
                            <button class="btn btn-outline-success" type="button" id="search-button">
                                <i class="fa-solid fa-search"></i>
                            </button>
                        </div>

                        <?php $__currentLoopData = $list_ujian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($data->flag == 'false'): ?>
                            <div class="card shadow-sm">
                                <div class="card-body d-flex align-items-center">
                                    <div class="foto me-2">
                                        <i class="fa-solid fa-clipboard-list fa-3x" style="color:#0275d8"></i>
                                    </div>
                                    <div class="desc">
                                        <h6 style="margin: 0"><?php echo e($data->nama_ujian); ?></h6>
                                        <p style="margin: 0;font-size: 16px;"><?php echo e(date('d-m-Y H:i',strtotime($data->jadwal_mulai))); ?> s/d <?php echo e(date('H:i',strtotime($data->jadwal_selesai))); ?></p>
                                        <div class="info d-flex">
                                            <?php if($data->status == 'running'): ?>
                                            <a href="<?php echo e(url('/confirm', $data->id_ujian_siswa)); ?>">
                                                <span class="badge bg-primary me-2 rounded-pill">Mulai</span>
                                            </a>
                                            <?php elseif($data->status == 'overdue'): ?>
                                            <a href="#">
                                                <span class="badge bg-danger me-2 rounded-pill">Sudah Melewati Jadwal</span>
                                            </a>
                                            <?php else: ?>
                                            <a href="#">
                                                <span class="badge bg-warning me-2 rounded-pill">Belum Mulai</span>
                                            </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p></p>
                            <?php else: ?>
                            <div class="card shadow-sm">
                                <div class="card-body d-flex align-items-center">
                                    <div class="foto me-2">
                                        <i class="fa-solid fa-clipboard-list fa-3x" style="color:#5cb85c"></i>
                                    </div>
                                    <div class="desc">
                                        <h6 style="margin: 0"><?php echo e($data->nama_ujian); ?></h6>
                                        <p style="margin: 0;font-size: 16px;"><?php echo e(date('d-m-Y H:i',strtotime($data->jadwal_mulai))); ?> s/d <?php echo e(date('H:i',strtotime($data->jadwal_selesai))); ?></p>
                                        <div class="info d-flex">
                                            <a href="#">
                                                <span class="badge bg-success me-2 rounded-pill">Selesai</span>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p></p>
                            <?php endif; ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php if(count($list_ujian) == 0): ?>
                        <center>
                            <div id="animationContainer" style="width: 220px; height: 220px;"></div>
                            <h6 style="color:grey;">Ujian belum tersedia</h6>
                        </center>
                        <?php endif; ?>

                    </div>

                    <!-- <div class="text-center">
                        <button class="btn btn-primary rounded-pill" id="load-more-button">Load More</button>
                    </div> -->

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

        <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->


        <script>
            // Fungsi untuk melakukan pencarian berdasarkan nama_ujian
            function searchUjian() {
                // Mendapatkan nilai input pencarian
                var searchValue = document.getElementById("search-input").value.toLowerCase();

                // Mendapatkan semua elemen card yang akan dicari
                var cards = document.getElementsByClassName("card");

                // Loop melalui setiap card dan cek apakah nama_ujian cocok dengan pencarian
                for (var i = 0; i < cards.length; i++) {
                    var card = cards[i];
                    var namaUjian = card.getElementsByTagName("h6")[0].innerText.toLowerCase();

                    if (namaUjian.includes(searchValue)) {
                        card.style.display = ""; // Tampilkan card jika cocok dengan pencarian
                    } else {
                        card.style.display = "none"; // Sembunyikan card jika tidak cocok dengan pencarian
                    }
                }
            }

            // Menghubungkan fungsi pencarian dengan tombol pencarian
            document.getElementById("search-button").addEventListener("click", searchUjian);

        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.9/lottie.min.js"></script>
        <script>
            const animationPath = "<?php echo e(url('not_found_animation.json')); ?>"; // Replace with the path to your Lottie JSON file
            const container = document.getElementById("animationContainer");
            const animation = bodymovin.loadAnimation({
                container: container,
                renderer: "svg",
                loop: true,
                autoplay: true,
                path: animationPath
            });
        </script>


    </body>
</html>
<?php /**PATH C:\xampp\htdocs\cbt_online_sekolah\resources\views/siswa/list.blade.php ENDPATH**/ ?>