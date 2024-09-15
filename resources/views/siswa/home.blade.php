<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>CBT Online - Home</title>

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

            @media only screen and (max-width: 600px) {
                .btn-kelas,
                .btn-ruang,
                footer {
                    font-size: small;
                }
            }

            /* section card */
            /* Google Fonts - Poppins */
            @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: "Poppins", sans-serif;
            }

            .profile-card {
                display: flex;
                flex-direction: column;
                align-items: center;
                /* max-width: 370px; */
                width: 100%;
                background: #fff;
                border-radius: 12px;
                padding: 25px;
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
                position: relative;
                height: 95%;
            }

            .profile-card::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                height: 25%;
                width: 100%;
                border-radius: 12px 12px 0 0;
                /* background-color: #4070f4; */
                background-color: #0093E9;
                background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);
            }

            .custom_bg {
                background-image: radial-gradient( circle 993px at 0.5% 50.5%,  rgba(137,171,245,0.37) 0%, rgba(245,247,252,1) 100.2% );
            }

            .image_custom {
                position: relative;
                height: 100px;
                width: 100px;
                border-radius: 50%;
                background-color: #4070f4;
                padding: 3px;
                margin-bottom: 10px;
            }

            .image_custom .profile-img {
                height: 100%;
                width: 100%;
                object-fit: cover;
                border-radius: 50%;
                border: 3px solid #fff;
            }

            .profile-card .text-data {
                display: flex;
                flex-direction: column;
                align-items: center;
                color: #333;
            }

            .text-data .name {
                font-size: 22px;
                font-weight: 500;
            }

            .text-data .job {
                font-size: 15px;
                font-weight: 400;
            }

            .profile-card .media-buttons {
                display: flex;
                align-items: center;
                margin-top: 15px;
            }

            .media-buttons .link {
                display: flex;
                align-items: center;
                justify-content: center;
                color: #fff;
                font-size: 18px;
                height: 34px;
                width: 34px;
                border-radius: 50%;
                margin: 0 8px;
                background-color: #4070f4;
                text-decoration: none;
            }

            .profile-card .buttons_custom {
                display: flex;
                align-items: center;
                margin-top: 25px;
            }

            .buttons_custom .button_custom {
                color: #fff;
                font-size: 14px;
                font-weight: 400;
                border: none;
                border-radius: 24px;
                margin: 0 10px;
                padding: 8px 24px;
                background-color: #4070f4;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .buttons_custom .button_custom:hover {
                background-color: #0e4bf1;
            }

            .profile-card .analytics {
                display: flex;
                align-items: center;
                margin-top: 25px;
            }

            .analytics .data {
                display: flex;
                align-items: center;
                color: #333;
                padding: 0 20px;
                border-right: 2px solid #e7e7e7;
            }

            .data i {
                font-size: 18px;
                margin-right: 6px;
            }

            .data:last-child {
                border-right: none;
            }

            @keyframes shimmer {
                0% {
                    background-position: -1000px;
                }
                100% {
                    background-position: 1000px;
                }
            }

            @keyframes fadeIn {
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
                    <img src="{{url('cbt_logo.png')}}" alt="Logo" height="40">
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

                <a href="{{ url('/logout') }}" class="btn btn-sm btn-danger rounded-pill">Logout</a>
            </div>
        </nav>

        <!-- content -->
        <div class="container mt-3 col-lg-8" style="margin-bottom: 150px">
            <div class="row">
                <div class="col">

                    <div class="card shadow-sm custom_bg">
                        <div class="card-body d-flex">
                            <div class="foto me-2">
                                @if (file_exists(public_path('avatar/'.Auth::user()->avatar)))
                                <img
                                    src="{{ asset('avatar/'.Auth::user()->avatar) }}"
                                    alt=""
                                    class="rounded-circle"
                                    width="75"
                                    height="75"
                                />
                                @else
                                <img
                                    src="{{url('sbadmin/img/avatar.png')}}"
                                    alt=""
                                    class="rounded-circle"
                                    width="75"
                                    height="75"
                                />
                                @endif
                            </div>
                            <div class="bio">
                                <h5 style="margin-top: 8px;">{{ $user->name }}</h5>
                                <p style="margin-top:-11px;">{{ $user->nama_kelas }}</p>
                                <p style="margin-top:-20px;">{{ $user->no_siswa }}</p>
                                <div class="info d-flex mt-3">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <p></p>

            <div class="row mt-1">
                <div class="col">

                    @foreach($list_ujian as $data)
                        @if($data->flag == 'false')
                        <div class="card shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <div class="foto me-2">
                                    <i class="fa-solid fa-clipboard-list fa-3x" style="color:#0275d8"></i>
                                </div>
                                <div class="desc">
                                    <h6 style="margin: 0">{{ $data->nama_ujian }}</h6>
                                    <p style="margin: 0;font-size: 16px;">{{ date('d-m-Y H:i',strtotime($data->jadwal_mulai)) }} s/d {{ date('H:i',strtotime($data->jadwal_selesai)) }}</p>
                                    <div class="info d-flex">
                                        @if($data->status == 'running')
                                        <a href="{{ url('/confirm', $data->id_ujian_siswa) }}">
                                            <span class="badge bg-primary me-2 rounded-pill">Mulai</span>
                                        </a>
                                        @elseif($data->status == 'overdue')
                                        <a href="#">
                                            <span class="badge bg-danger me-2 rounded-pill">Sudah Melewati Jadwal</span>
                                        </a>
                                        @else
                                        <a href="#">
                                            <span class="badge bg-warning me-2 rounded-pill">Belum Mulai</span>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p></p>
                        @endif
                    @endforeach

                    @if(count($list_ujian) == 0)
                    <center>
                        <div id="animationContainer" style="width: 220px; height: 220px;"></div>
                    </center>
                    @endif

                </div>
            </div>

        </div>

        <footer
            class="bg-primary text-white text-center text-lg-start fixed-bottom d-flex justify-content-around py-2"
        >
            <div class="home">
                <div class="home text-center">
                    <a
                        href="{{url('home')}}"
                        class="text-white d-flex flex-column align-items-center justify-content-center"
                    >
                        <i class="fa-solid fa-home mb-2"></i>
                        <span>Home</span>
                    </a>
                </div>
            </div>
            <div class="search text-center">
                <a
                    href="{{url('list')}}"
                    class="text-white d-flex flex-column align-items-center justify-content-center"
                >
                    <i class="fa-solid fa-calendar mb-2"></i>
                    <span>Ujian</span>
                </a>
            </div>

            <div class="profile">
                <div class="profile text-center">
                    <a
                        href="{{url('profile')}}"
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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.9/lottie.min.js"></script>
        <script>
            const animationPath = "{{url('opening.json')}}"; // Replace with the path to your Lottie JSON file
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
