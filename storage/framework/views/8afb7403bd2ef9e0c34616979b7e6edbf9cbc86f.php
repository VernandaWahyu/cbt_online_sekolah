

<?php $__env->startSection('list-bank-soal', 'active'); ?>
<?php $__env->startSection('list-bank-soal', 'active'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <style>
        #div_jawaban_2 {
            display: none;
        }

        #div_jawaban_3 {
            display: none;
        }

        #div_jawaban_4 {
            display: none;
        }

        #div_jawaban_5 {
            display: none;
        }

        #section_soal,
        #accordionExample {
            display: none;
        }

        #accordionRumus {
            display: none;
        }

        #section_jawaban {
            display: none;
        }

        .ck-editor__editable {
            min-height: 200px;
        }

        p {
            /* font-weight: bold; */
            color: black;
        }

        .cols2 {
            display: flex;
            align-items: left;
            justify-content: left;
            margin-bottom: 30px;
        }


        .col2 {
            margin: 0 15px;
            width: 100%;
        }


        .sk_bg {
            animation-duration: 1s;
            animation-fill-mode: forwards;
            animation-iteration-count: infinite;
            animation-name: sk_bg_animation;
            animation-timing-function: linear;
            background: #f6f7f8;
            background: linear-gradient(to right, #eee 8%, #ddd 18%, #eee 33%);
            background-size: 800px 104px;
            position: relative;
            width: 100%;
            margin-bottom: 10px;
        }


        .sk_bg.big {
            height: 96px;
        }


        .sk_bg.small {
            height: 20px;
        }


        .sk_bg.small2 {
            height: 15px;
        }

        /* section shimmer jawaban */
        .cols2j {
            display: flex;
            align-items: left;
            justify-content: left;
            margin-bottom: 30px;
        }


        .col2j {
            margin: 0 15px;
            width: 100%;
        }


        .sk_bgj {
            animation-duration: 1s;
            animation-fill-mode: forwards;
            animation-iteration-count: infinite;
            animation-name: sk_bg_animation;
            animation-timing-function: linear;
            background: #f6f7f8;
            background: linear-gradient(to right, #eee 8%, #ddd 18%, #eee 33%);
            background-size: 800px 104px;
            position: relative;
            width: 100%;
            margin-bottom: 10px;
        }


        .sk_bgj.bigj {
            height: 96px;
        }


        .sk_bgj.smallj {
            height: 20px;
        }


        .sk_bgj.small2j {
            height: 15px;
        }

        @keyframes  sk_bg_animation {
            0% {
                background-position: -468px 0
            }

            100% {
                background-position: 468px 0
            }
        }


        @-webkit-keyframes sk_bg_animation {
            0% {
                background-position: -468px 0
            }

            100% {
                background-position: 468px 0
            }
        }

        /* section new */
        .loader,
        .loader:after {
            border-radius: 50%;
            width: 10em;
            height: 10em;
        }

        .loader {
            margin: 60px auto;
            font-size: 10px;
            position: relative;
            text-indent: -9999em;
            border-top: 1.1em solid rgba(255, 255, 255, 0.2);
            border-right: 1.1em solid rgba(255, 255, 255, 0.2);
            border-bottom: 1.1em solid rgba(255, 255, 255, 0.2);
            border-left: 1.1em solid #ffffff;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-animation: load8 1.1s infinite linear;
            animation: load8 1.1s infinite linear;
        }

        @-webkit-keyframes load8 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes  load8 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        #loadingDiv {
            position: absolute;
            ;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #000;
        }

        @media  only screen and (max-width: 600px) {}
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <h4 style="color:black;"><?php echo e($bank_soal->nama_bank_soal); ?></h4>
                    <form action="<?php echo e(url('bank_soal/soal/store')); ?>" method="POST" id="formAddModal" novalidate>
                        <?php echo csrf_field(); ?>
                        <div id="shimmer">
                            <div class="cols2">
                                <div class="col2">
                                    <div class="sk_bg big"></div>
                                    <div class="sk_bg small"></div>
                                    <div class="sk_bg small2"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="section_soal">
                            <label for="">Soal No : <?php echo e($urutan); ?></label>
                            <textarea name="soal" id="soal" class="soal">
                                <?php echo e(old('soal')); ?>

                            </textarea>
                            <input type="hidden" name="bank_soal_id" value="<?php echo e($bank_soal->id); ?>" id="">
                            <?php $__errorArgs = ['soal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="alert alert-danger mt-2 " role="alert" id="alert-soal">
                                    <?php echo e($message); ?>

                                </div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                            <br>

                            <!-- <div class="accordion" id="accordionRumus">
                                
                                <div class="card" id="div_rumus">
                                    <div class="card-header" id="div_rumus">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left" type="button"
                                                data-toggle="collapse" data-target="#collapseRumus" aria-expanded="true"
                                                aria-controls="collapseRumus">
                                                Rumus
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseRumus" class="collapse" aria-labelledby="headingRumus"
                                        data-parent="#accordionRumus">
                                        <div class="card-body">                                            
                                            <div class="">
                                                <div class="form-group">
                                                    <textarea class="rumus" id="rumus"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                            <hr>
                            <div id="shimmerj">
                                <div class="cols2j">
                                    <div class="col2j">
                                        <div class="sk_bgj bigj"></div>
                                        <div class="sk_bgj smallj"></div>
                                        <div class="sk_bgj small2j"></div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="accordion" id="accordionExample">
                                
                                <div class="card" id="div_jawaban_1">
                                    <div class="card-header" id="div_jawaban_1">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left" type="button"
                                                data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                Jawaban 1
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <label for="">Nilai Jawaban 1</label>
                                            <div class="d-flex flex-wrap">
                                                <div class="form-group mr-2" style="width: 500px">
                                                    <input type="text" required name="nilai[]" value="0"
                                                        id="sectionTitle" class="form-control">
                                                    <input type="hidden" value="1" id="no_jawaban" name="no_jawaban[]"
                                                        value="<?php echo e(old('no_jawaban')); ?>">
                                                </div>
                                                <div class="d-flex flex-wrap" style="height: 38px">

                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="form-group">
                                                    <label for="">Jawaban 1</label>
                                                    <textarea name="jawaban[]" required class="jawaban" id="jawaban"></textarea>
                                                    <?php $__errorArgs = ['jawaban'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="alert alert-danger mt-2 " role="alert" id="alert-soal">
                                                            <?php echo e($message); ?>

                                                        </div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card" id="div_jawaban_2">
                                    <div class="card-header" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                                data-toggle="collapse" data-target="#collapseTwo" id="#collapseTwoBtn"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                Jawaban 2
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <label for="">Nilai Jawaban 2</label>
                                            <div class="" id="fieldGroupTemplate">
                                                <div class="d-flex flex-wrap">
                                                    <div class="form-group floating-label mr-2" style="width: 500px">
                                                        <input type="text" name="nilai[]" id="sectionTitle"
                                                            value="0" class="form-control">
                                                        <input type="hidden" value="" id="no_jawaban2"
                                                            name="no_jawaban[]" value="<?php echo e(old('no_jawaban')); ?>">
                                                    </div>

                                                    <div class="d-flex flex-wrap" style="height: 38px">

                                                        <a href="javascript:void(0)" id="hapus2"
                                                            class="btn btn-danger remove"><span
                                                                class="glyphicon glyphicon glyphicon-remove"
                                                                aria-hidden="true"></span>
                                                            Hapus</a>
                                                    </div>

                                                </div>

                                                <div class="">
                                                    <div class="form-group">
                                                        <label for="">Jawaban 2</label>
                                                        <textarea name="jawaban[]" class="jawaban2"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card" id="div_jawaban_3">
                                    <div class="card-header" id="headingThree">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                                data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                                aria-controls="collapseThree">
                                                Jawaban 3
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <label for="">Nilai Jawaban 3</label>
                                            <div class="" id="fieldGroupTemplate">
                                                <div class="d-flex flex-wrap">
                                                    <div class="form-group floating-label mr-2" style="width: 500px">
                                                        <input type="text" name="nilai[]" id="sectionTitle"
                                                            value="0" class="form-control">
                                                        <input type="hidden" value="" id="no_jawaban3"
                                                            name="no_jawaban[]" value="<?php echo e(old('no_jawaban')); ?>">
                                                    </div>

                                                    <div class="d-flex flex-wrap" style="height: 38px">

                                                        <a href="javascript:void(0)" id="hapus3"
                                                            class="btn btn-danger remove"><span
                                                                class="glyphicon glyphicon glyphicon-remove"
                                                                aria-hidden="true"></span>
                                                            Hapus</a>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div class="form-group">
                                                        <label for="">Jawaban 3</label>
                                                        <textarea name="jawaban[]" class="jawaban3"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card" id="div_jawaban_4">
                                    <div class="card-header" id="headingFour">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                                data-toggle="collapse" data-target="#collapseFour" aria-expanded="false"
                                                aria-controls="collapseFour">
                                                Jawaban 4
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <label for="">Nilai Jawaban 4</label>
                                            <div class="" id="fieldGroupTemplate">

                                                <div class="d-flex flex-wrap">
                                                    <div class="form-group floating-label mr-2" style="width: 500px">
                                                        <input type="text" name="nilai[]" id="sectionTitle"
                                                            value="0" class="form-control">
                                                        <input type="hidden" value="" id="no_jawaban4"
                                                            name="no_jawaban[]" value="<?php echo e(old('no_jawaban')); ?>">
                                                    </div>
                                                    <div class="d-flex flex-wrap" style="height: 38px">

                                                        <a href="javascript:void(0)" id="hapus4"
                                                            class="btn btn-danger remove"><span
                                                                class="glyphicon glyphicon glyphicon-remove"
                                                                aria-hidden="true"></span>
                                                            Hapus</a>
                                                    </div>
                                                </div>

                                                <div class="">
                                                    <div class="form-group">
                                                        <label for="">Jawaban 4</label>
                                                        <textarea name="jawaban[]" class="jawaban4"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card" id="div_jawaban_5">
                                    <div class="card-header" id="headingFive">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                                data-toggle="collapse" data-target="#collapseFive" aria-expanded="false"
                                                aria-controls="collapseFive">
                                                Jawaban 5
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <label for="">Nilai Jawaban 5</label>
                                            <div class="" id="fieldGroupTemplate">

                                                <div class="d-flex flex-wrap">
                                                    <div class="form-group floating-label mr-2" style="width: 500px">
                                                        <input type="text" name="nilai[]" id="sectionTitle"
                                                            value="0" class="form-control">
                                                        <input type="hidden" value="" id="no_jawaban5"
                                                            name="no_jawaban[]" value="<?php echo e(old('no_jawaban')); ?>">
                                                    </div>
                                                    <div class="d-flex flex-wrap" style="height: 38px">
                                                        
                                                        <a href="javascript:void(0)" id="hapus5"
                                                            class="btn btn-danger remove"><span
                                                                class="glyphicon glyphicon glyphicon-remove"
                                                                aria-hidden="true"></span>
                                                            Hapus</a>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <div class="form-group">
                                                        <label for="">Jawaban 5</label>
                                                        <textarea name="jawaban[]" class="jawaban5"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="contaigner" id="section_jawaban">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            
                            <a href="javascript:void(0)" class="btn btn-success addMore" id="add">
                                <span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span>
                                Tambahkan Jawaban
                            </a>
                            
                            <a href="javascript:void(0)" class="btn btn-success addMore d-none" id="add2">
                                <span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span>
                                Tambahkan Jawaban
                            </a>
                            
                            <a href="javascript:void(0)" class="btn btn-success addMore d-none" id="add3">
                                <span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span>
                                Tambahkan Jawaban
                            </a>
                            
                            <a href="javascript:void(0)" class="btn btn-success addMore d-none" id="add4">
                                <span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span>
                                Tambahkan Jawaban
                            </a>

                        </div>
                    </form>
                </div>
                
            </div>
            
        </div>
        <!-- /.container-fluid -->
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.all.min.js">
    </script>

    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script> -->
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/super-build/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/super-build/translations/es.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/css/suneditor.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.css">

    <script src="https://cdn.jsdelivr.net/npm/katex@0.11.1/dist/katex.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/suneditor@latest/dist/suneditor.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/suneditor@latest/assets/css/suneditor-contents.css" rel="stylesheet">


    <script>
        //$('body').append('<div style="" id="shimmer"><div class="loader">Loading...</div></div>');
        $(window).on('load', function() {
            setTimeout(removeLoader, 10); //wait for page load PLUS two seconds.
            setTimeout(removeLoader2, 10);
        });

        function removeLoader() {
            $("#shimmer").fadeOut(500, function() {
                $("#shimmer").remove(); //makes page more lightweight 
                document.getElementById("section_soal").style.display = "block";
                document.getElementById("accordionExample").style.display = "block";
                document.getElementById("accordionRumus").style.display = "block";
            });
        }

        function removeLoader2() {
            $("#shimmerj").fadeOut(500, function() {
                $("#shimmerj").remove(); //makes page more lightweight 
                document.getElementById("section_jawaban").style.display = "block";
            });
        }

        $(document).ready(function() {
            //add more section
            function cekClass() {
                if ($('#div_jawaban_2').hasClass("d-none") || $(`#div_jawaban_2`).css('display') ==
                    'none') {
                    $("#add2").removeClass("d-none");
                } else if ($('#div_jawaban_3').hasClass("d-none") || $(`#div_jawaban_3`).css('display') ==
                    'none') {
                    $("#add3").removeClass("d-none")
                } else if ($('#div_jawaban_4').hasClass("d-none") || $(`#div_jawaban_4`).css('display') ==
                    'none') {
                    $("#add4").removeClass("d-none");
                } else if ($('#div_jawaban_5').hasClass("d-none") || $(`#div_jawaban_5`).css('display') ==
                    'none') {
                    $("#add").removeClass("d-none");
                }
            }

            function collapseAll() {
                $("#collapseOne").removeClass('show');
                $("#collapseTwo").removeClass('show');
                $("#collapseThree").removeClass('show');
                $("#collapseFour").removeClass('show');
                $("#collapseFive").removeClass('show');
            }

            $("#add").click(function() {
                document.getElementById("div_jawaban_2").style.display = "block";
                $("#no_jawaban2").val(2);
                $("#add").addClass("d-none");
                $("#add2").removeClass("d-none");
                collapseAll()
                $("#collapseTwo").addClass('show');
            });



            $("#add2").click(function() {
                document.getElementById("div_jawaban_3").style.display = "block";
                $("#no_jawaban3").val(3);
                $("#add2").addClass("d-none");
                $("#add3").removeClass("d-none");
                collapseAll()
                $("#collapseThree").addClass('show');
            });

            $("#add3").click(function() {
                document.getElementById("div_jawaban_4").style.display = "block";
                $("#no_jawaban4").val(4);
                $("#add3").addClass("d-none");
                $("#add4").removeClass("d-none");
                collapseAll()
                $("#collapseFour").addClass('show');
            });

            $("#add4").click(function() {
                document.getElementById("div_jawaban_5").style.display = "block";
                $("#no_jawaban5").val(5);
                $("#add4").addClass("d-none");
                collapseAll()
                $("#collapseFive").addClass('show');
            });

            //remove section
            function hideAll() {
                $("#add").addClass("d-none");
                $("#add2").addClass("d-none");
                $("#add3").addClass("d-none");
                $("#add4").addClass("d-none");
            }

            function showButton() {
                hideAll()
                if ($('#div_jawaban_2').hasClass("d-none") || $(`#div_jawaban_2`).css('display') ==
                    'none') {
                    $("#add").removeClass("d-none");
                } else if ($('#div_jawaban_3').hasClass("d-none") || $(`#div_jawaban_3`).css('display') ==
                    'none') {
                    $("#add2").removeClass("d-none")
                } else if ($('#div_jawaban_4').hasClass("d-none") || $(`#div_jawaban_4`).css('display') ==
                    'none') {
                    $("#add3").removeClass("d-none");
                } else if ($('#div_jawaban_5').hasClass("d-none") || $(`#div_jawaban_5`).css('display') ==
                    'none') {
                    $("#add4").removeClass("d-none");
                }
            }
            $("#hapus2").click(function() {
                document.getElementById("div_jawaban_2").style.display = "none";
                $("#no_jawaban2").val('');
                showButton()
            });

            $("#hapus3").click(function() {
                document.getElementById("div_jawaban_3").style.display = "none";
                $("#no_jawaban3").val('');
                showButton()
            });

            $("#hapus4").click(function() {
                document.getElementById("div_jawaban_4").style.display = "none";
                $("#no_jawaban4").val('');
                showButton()
            });

            $("#hapus5").click(function() {
                document.getElementById("div_jawaban_5").style.display = "none";
                $("#no_jawaban5").val('');
                showButton()
            });

            CKEDITOR.ClassicEditor.create(document.querySelector(".soal"), {
                // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                // on: {
                //     instanceReady: function(evt) {
                //         document.getElementById('shimmer').style.visibility = "hidden";
                //     }
                // },
                toolbar: {
                    items: [
                        'bold', 'italic', 'underline', 'subscript', 'superscript', '|',
                        'bulletedList', 'numberedList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                        'alignment', '|',
                        'link', 'imageUpload', 'insertTable', 'mediaEmbed', '|',
                        'specialCharacters',
                    ],
                    shouldNotGroupWhenFull: true
                },
                placeholder: '',
                fontSize: {
                    options: [10, 12, 14, 'default', 18, 20, 22],
                    supportAllValues: true
                },
                ckfinder: {
                    uploadUrl: '<?php echo e(route('ckeditor.upload')); ?>?id_bank_soal=<?php echo e($bank_soal->id); ?>&_token=<?php echo e(csrf_token()); ?>',
                },
                removePlugins: [
                    // These two are commercial, but you can try them out without registering to a trial.
                    // 'ExportPdf',
                    // 'ExportWord',
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                    // Storing images as Base64 is usually a very bad idea.
                    // Replace it on production website with other solutions:
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                    // 'Base64UploadAdapter',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                ]
            });

            // CKEDITOR.ClassicEditor.create(document.querySelector(".rumus"), {
            //     plugins: [ 'MathType'],
            //     toolbar: {
            //         items: [
            //             'MathType',
            //             'ChemType',
            //         ],
            //         shouldNotGroupWhenFull: true
            //     },
            //     placeholder: '',
            //     fontSize: {
            //         options: [10, 12, 14, 'default', 18, 20, 22],
            //         supportAllValues: true
            //     },
            //     removePlugins: [
            //         // These two are commercial, but you can try them out without registering to a trial.
            //         // 'ExportPdf',
            //         // 'ExportWord',
            //         'CKBox',
            //         'CKFinder',
            //         'EasyImage',
            //         // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
            //         // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
            //         // Storing images as Base64 is usually a very bad idea.
            //         // Replace it on production website with other solutions:
            //         // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
            //         // 'Base64UploadAdapter',
            //         'RealTimeCollaborativeComments',
            //         'RealTimeCollaborativeTrackChanges',
            //         'RealTimeCollaborativeRevisionHistory',
            //         'PresenceList',
            //         'Comments',
            //         'TrackChanges',
            //         'TrackChangesData',
            //         'RevisionHistory',
            //         'Pagination',
            //         'WProofreader',
            //     ]
            // });

            CKEDITOR.ClassicEditor.create(document.querySelector(".jawaban"), {
                // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                // on: {
                //     instanceReady: function(evt) {
                //         document.getElementById('shimmer').style.visibility = "hidden";
                //     }
                // },
                toolbar: {
                    items: [
                        //'exportPDF','exportWord', '|',
                        //'findAndReplace', 'selectAll', '|',
                        //'heading', '|',
                        'bold', 'italic', 'underline', 'subscript', 'superscript', '|',
                        'bulletedList', 'numberedList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        //'-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                        'alignment', '|',
                        'link', 'imageUpload', 'insertTable', 'mediaEmbed', '|',
                        'specialCharacters'
                    ],
                    shouldNotGroupWhenFull: true
                },
                placeholder: '',
                fontSize: {
                    options: [10, 12, 14, 'default', 18, 20, 22],
                    supportAllValues: true
                },
                ckfinder: {
                    uploadUrl: '<?php echo e(route('ckeditor.upload')); ?>?id_bank_soal=<?php echo e($bank_soal->id); ?>&_token=<?php echo e(csrf_token()); ?>',
                },
                removePlugins: [
                    // These two are commercial, but you can try them out without registering to a trial.
                    // 'ExportPdf',
                    // 'ExportWord',
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                    // Storing images as Base64 is usually a very bad idea.
                    // Replace it on production website with other solutions:
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                    // 'Base64UploadAdapter',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                    // from a local file system (file://) - load this site via HTTP server if you enable MathType
                    'MathType'
                ]
            });

            CKEDITOR.ClassicEditor.create(document.querySelector(".jawaban2"), {
                // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                // on: {
                //     instanceReady: function(evt) {
                //         document.getElementById('shimmer').style.visibility = "hidden";
                //     }
                // },
                toolbar: {
                    items: [
                        //'exportPDF','exportWord', '|',
                        //'findAndReplace', 'selectAll', '|',
                        //'heading', '|',
                        'bold', 'italic', 'underline', 'subscript', 'superscript', '|',
                        'bulletedList', 'numberedList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        //'-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                        'alignment', '|',
                        'link', 'imageUpload', 'insertTable', 'mediaEmbed', '|',
                        'specialCharacters'
                    ],
                    shouldNotGroupWhenFull: true
                },
                placeholder: '',
                fontSize: {
                    options: [10, 12, 14, 'default', 18, 20, 22],
                    supportAllValues: true
                },
                ckfinder: {
                    uploadUrl: '<?php echo e(route('ckeditor.upload')); ?>?id_bank_soal=<?php echo e($bank_soal->id); ?>&_token=<?php echo e(csrf_token()); ?>',
                },
                removePlugins: [
                    // These two are commercial, but you can try them out without registering to a trial.
                    // 'ExportPdf',
                    // 'ExportWord',
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                    // Storing images as Base64 is usually a very bad idea.
                    // Replace it on production website with other solutions:
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                    // 'Base64UploadAdapter',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                    // from a local file system (file://) - load this site via HTTP server if you enable MathType
                    'MathType'
                ]
            });

            CKEDITOR.ClassicEditor.create(document.querySelector(".jawaban3"), {
                // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                // on: {
                //     instanceReady: function(evt) {
                //         document.getElementById('shimmer').style.visibility = "hidden";
                //     }
                // },
                toolbar: {
                    items: [
                        //'exportPDF','exportWord', '|',
                        //'findAndReplace', 'selectAll', '|',
                        //'heading', '|',
                        'bold', 'italic', 'underline', 'subscript', 'superscript', '|',
                        'bulletedList', 'numberedList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        //'-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                        'alignment', '|',
                        'link', 'imageUpload', 'insertTable', 'mediaEmbed', '|',
                        'specialCharacters'
                    ],
                    shouldNotGroupWhenFull: true
                },
                placeholder: '',
                fontSize: {
                    options: [10, 12, 14, 'default', 18, 20, 22],
                    supportAllValues: true
                },
                ckfinder: {
                    uploadUrl: '<?php echo e(route('ckeditor.upload')); ?>?id_bank_soal=<?php echo e($bank_soal->id); ?>&_token=<?php echo e(csrf_token()); ?>',
                },
                removePlugins: [
                    // These two are commercial, but you can try them out without registering to a trial.
                    // 'ExportPdf',
                    // 'ExportWord',
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                    // Storing images as Base64 is usually a very bad idea.
                    // Replace it on production website with other solutions:
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                    // 'Base64UploadAdapter',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                    // from a local file system (file://) - load this site via HTTP server if you enable MathType
                    'MathType'
                ]
            });

            CKEDITOR.ClassicEditor.create(document.querySelector(".jawaban4"), {
                // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                // on: {
                //     instanceReady: function(evt) {
                //         document.getElementById('shimmer').style.visibility = "hidden";
                //     }
                // },
                toolbar: {
                    items: [
                        //'exportPDF','exportWord', '|',
                        //'findAndReplace', 'selectAll', '|',
                        //'heading', '|',
                        'bold', 'italic', 'underline', 'subscript', 'superscript', '|',
                        'bulletedList', 'numberedList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        //'-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                        'alignment', '|',
                        'link', 'imageUpload', 'insertTable', 'mediaEmbed', '|',
                        'specialCharacters'
                    ],
                    shouldNotGroupWhenFull: true
                },
                placeholder: '',
                fontSize: {
                    options: [10, 12, 14, 'default', 18, 20, 22],
                    supportAllValues: true
                },
                ckfinder: {
                    uploadUrl: '<?php echo e(route('ckeditor.upload')); ?>?id_bank_soal=<?php echo e($bank_soal->id); ?>&_token=<?php echo e(csrf_token()); ?>',
                },
                removePlugins: [
                    // These two are commercial, but you can try them out without registering to a trial.
                    // 'ExportPdf',
                    // 'ExportWord',
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                    // Storing images as Base64 is usually a very bad idea.
                    // Replace it on production website with other solutions:
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                    // 'Base64UploadAdapter',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                    // from a local file system (file://) - load this site via HTTP server if you enable MathType
                    'MathType'
                ]
            });

            CKEDITOR.ClassicEditor.create(document.querySelector(".jawaban5"), {
                // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                // on: {
                //     instanceReady: function(evt) {
                //         document.getElementById('shimmer').style.visibility = "hidden";
                //     }
                // },
                toolbar: {
                    items: [
                        //'exportPDF','exportWord', '|',
                        //'findAndReplace', 'selectAll', '|',
                        //'heading', '|',
                        'bold', 'italic', 'underline', 'subscript', 'superscript', '|',
                        'bulletedList', 'numberedList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        //'-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                        'alignment', '|',
                        'link', 'imageUpload', 'insertTable', 'mediaEmbed', '|',
                        'specialCharacters'
                    ],
                    shouldNotGroupWhenFull: true
                },
                placeholder: '',
                fontSize: {
                    options: [10, 12, 14, 'default', 18, 20, 22],
                    supportAllValues: true
                },
                ckfinder: {
                    uploadUrl: '<?php echo e(route('ckeditor.upload')); ?>?id_bank_soal=<?php echo e($bank_soal->id); ?>&_token=<?php echo e(csrf_token()); ?>',
                },
                removePlugins: [
                    // These two are commercial, but you can try them out without registering to a trial.
                    // 'ExportPdf',
                    // 'ExportWord',
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                    // Storing images as Base64 is usually a very bad idea.
                    // Replace it on production website with other solutions:
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                    // 'Base64UploadAdapter',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                    // from a local file system (file://) - load this site via HTTP server if you enable MathType
                    'MathType'
                ]
            });

            // $('.soal').summernote({
            //     tabsize: 2,
            //     height: 200
            // });

            $(window).click(function() {
                document.querySelector('.soal').value = soal.getContents();
                document.querySelector('.rumus').value = soal.getContents();
                document.querySelector('.jawaban').value = jawaban.getContents();
                document.querySelector('.jawaban2').value = jawaban2.getContents();
                document.querySelector('.jawaban3').value = jawaban3.getContents();
                document.querySelector('.jawaban4').value = jawaban4.getContents();
                document.querySelector('.jawaban5').value = jawaban5.getContents();
            });

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\cbt_online_sekolah\resources\views/admin/bank_soal/soal_tambah.blade.php ENDPATH**/ ?>