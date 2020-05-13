@extends('layout.hero')

@section('content')
@php
    foreach($data as $dt){
        $newData[$dt->name] = $dt;
    }
@endphp

    <div class="" style="">
        <section class="section-top-content">
            <!-- BEGIN PlACE PAGE CONTENT HERE -->
                <div class="row content">
                    <div class="col-8 p-0">
                        <div id="carouselExampleIndicators" class="carousel slide" style="width:100%; height:auto;" data-ride="carousel">

                            <div class="carousel-inner corousel-lg">
                                <div class="carousel-item active">
                                <img class="d-block w-100" src="{{ asset ('assets/img/test_masif.svg') }}" alt="First slide">
                                </div>
                                <div class="carousel-item">
                                <img class="d-block w-100" src="{{ asset ('assets/img/relawan.svg') }}" alt="Second slide">
                                </div>
                            </div>

                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>

                            </ol>

                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-4 call-content">
                        <div class="row h-100 row-gap">
                            <div class="col-12">
                                <div id="card_call_center" class="card h-100 card-call" style="cursor: pointer">
                                    <div class="card-body">
                                        <div class="call-center-header">
                                            <span id="call_center_name" class="d-block main-title">{{ $data[0]->call_center_name}}</span>
                                            <span class="d-block sub-title">Nomor Darurat</span>
                                        </div>
                                        <div class="call-center-body">
                                            <img src="{{ asset('assets/img/callcenter-icon.svg') }}" class="number-call-icon" alt="">
                                            <a id="call_center_number" href="tel:{{ $data[0]->call_center_number}}">{{ str_replace("-"," ", $data[0]->call_center_number)}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div id="card_hotline" class="card h-100 card-call" style="cursor: pointer">
                                    <div class="card-body">
                                        <div class="call-center-header">
                                            <span id="hotline_name"  class="d-block main-title">{{ $data[0]->hotline_name}}</span>
                                            <span class="d-block sub-title">Pertanyaan Umum</span>
                                        </div>
                                        <div class="call-center-body">
                                            <img src="{{ asset('assets/img/callcenter-icon.svg') }}" class="number-call-icon" alt="">
                                            <a id="hot_line_number" href="tel:{{ $data[0]->hotline_number}}">{{ str_replace("-"," ", $data[0]->hotline_number)}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            <!-- END PLACE PAGE CONTENT HERE -->
        </section>

        <section style="padding-top: 60px; padding-bottom:65px;">
            <div class="row content">
                <div class="col-12 p-0">
                    <h4>
                        <b>Data Pantauan</b>
                    </h4>
                    <label class="sub-color animation-element fade-in" style="font-weight: 300;">
                        Update Terakhir: Minggu, 12 Apr 2020 15.13
                    </label>
                </div>
                <div class="col-12 p-0">
                    {{-- @dump($newData, $data) --}}
                    <div class="swiper-container swiper-container-initialized swiper-container-horizontal swiper-container-free-mode" style="margin-top:30px;padding:0px 10px;">
                        <div class="swiper-wrapper">
                            @php
                                $val = 0;
                            @endphp

                            @foreach ($data as $key)
                                {{-- @dump($data[$val]->name) --}}
                                <div class="swiper-slide swiper-slide-active" style="width: auto; margin-right: 30px;">
                                    <div class="card card-location">
                                        <div class="card-body card-body-data text-center provinceSelector">{{ $data[$val]->name }}</div>
                                    </div>
                                </div>
                                @php
                                    $val++;
                                @endphp
                            @endforeach
                        </div>

                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>

                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                    </div>

                </div>
                <div class="col-4 p-0">
                    <div class="card card-data card-data-left animation-element slide-bottom">
                        <div class="card-body-data wrap">
                            <div class="call-center-header w-auto">
                                <img src="{{ asset('assets/img/terkonfirmasi.svg') }}" class="number-call-icon" width="auto" height="30" alt="">
                            </div>
                            <div class=" whitespace-data-left mt-0">
                                <span class="d-block main-title-md" >TERKONFIRMASI</span>
                                <span id="txt_konfirm" class="color-orange data-angka count">0858 </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 p-0">
                    <div class="card card-data card-data-middle animation-element slide-bottom-dly-135s">
                        <div class="card-body-data wrap">
                            <div class="call-center-header w-auto">
                                <img src="{{ asset('assets/img/meninggal.svg') }}" class="number-call-icon" width="auto" height="30" alt="">
                            </div>
                            <div class=" whitespace-data-left mt-0">
                                <span class="d-block main-title-md" >MENINGGAL</span>
                                <span id="txt_meninggal" class="color-purple data-angka count">0858 </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 p-0">
                    <div class="card card-data card-data-right animation-element slide-bottom-dly-145s">
                        <div class="card-body-data wrap">
                            <div class="call-center-header w-auto">
                                <img src="{{ asset('assets/img/sembuh.svg') }}" class="number-call-icon" width="auto" height="30" alt="">
                            </div>
                            <div class=" whitespace-data-left mt-0">
                                <span class="d-block main-title-md" >SEMBUH</span>
                                <span id="txt_sembuh" class="color-green data-angka count">0858 </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 p-0 text-right">
                    <a href="#" class="link-purple">
                        Lihat Lebih Lengkap >
                    </a>
                </div>
            </div>
        </section>
    </div>

    <section class="section-whitespace">
        <div class="row content">
            <div class="col-6 p-0">
                <h2>
                    <b>Resiko dari COVID-19</b>
                </h2>
                <p class="sub-color sub-text" style="margin-top: 30px; margin-right:50px;">
                    COVID-19 merupakan penyakit yang disebabkan Novel Coronavirus 2019.
                    Meski bergejala mirip dengan flu biasa, COVID-19 sampai saat ini memiliki fatalitas lebih tinggi.
                    Virus ini juga menyebar dengan sangat cepat karena bisa pindah dari orang ke orang bahkan sebelum orang tersebut menunjukkan gejala.
                    Penting bagi Anda untuk menilai kondisi secara mandiri. Anda bergejala?
                </p>
                <a href="https://covid19.prixa.ai" class="btn btn-outline-purple animation-element fade-in" style="margin-top: 55px;" role="button" target="_blank">
                    Periksa Mandiri
                </a>
            </div>
            <div id="scene" class="col-6 p-0">
                {{-- <div>
                    <img src="{{ asset('assets/img/computer_man.svg') }}" style="position:absolute;right:0" class="float-right" width="auto" height="auto" alt="">
                </div> --}}
                <div data-depth="0.1" style="z-index:1;">
                    <img src="{{ asset('assets/img/man_character/bg-man.svg') }}" style="position:relative; left:100px; top:20px;" width="auto" height="auto" alt="">
                </div>
                <div data-depth="0.07" style="z-index:5;">
                    <img src="{{ asset('assets/img/man_character/video_record.svg') }}" style="position:relative; left:300px; top:70px;" width="auto" height="auto" alt="">
                </div>
                <div data-depth="-0.22" style="z-index:6;">
                    <img src="{{ asset('assets/img/man_character/monitor.svg') }}" style="position:relative; left:205px; top:125px;" width="auto" height="auto" alt="">
                </div>
                <div data-depth="-0.12" style="z-index:6;">
                    <img src="{{ asset('assets/img/man_character/gelas.svg') }}" style="position:relative; left:160px; top:195px;" width="auto" height="auto" alt="">
                </div>
                <div data-depth="-0.1" style="z-index:7;">
                    <img src="{{ asset('assets/img/man_character/badan_meja.svg') }}" style="position:relative; left:130px; top:210px;" width="auto" height="auto" alt="">
                </div>
                <div data-depth="-0.15" style="z-index:3;">
                    <img src="{{ asset('assets/img/man_character/kakimeja-kanan.svg') }}" style="position:relative; left:130px; top:223px;" width="auto" height="auto" alt="">
                </div>
                <div data-depth="-0.05" style="z-index:3;">
                    <img src="{{ asset('assets/img/man_character/kakimeja-kiri.svg') }}" style="position:relative; left:250px; top:220px;" width="auto" height="auto" alt="">
                </div>
                <div data-depth="-0.02" style="z-index:4;">
                    <img src="{{ asset('assets/img/man_character/badan.svg') }}" style="position:relative; left:290px; top:133px;" width="auto" height="auto" alt="">
                </div>
                <div data-depth="0.01" style="z-index:4;">
                    <img src="{{ asset('assets/img/man_character/kepala.svg') }}" style="position:relative; left:380px; top:76px;" width="auto" height="auto" alt="">
                </div>
                <div data-depth="-0.01" style="z-index:2;">
                    <img src="{{ asset('assets/img/man_character/kaki-kanan.svg') }}" style="position:relative; left:350px; top:240px;" width="auto" height="auto" alt="">
                </div>
                <div data-depth="0.03" style="z-index:3;">
                    <img src="{{ asset('assets/img/man_character/bangku.svg') }}" style="position:relative; left:380px; top:290px;" width="auto" height="auto" alt="">
                </div>
                {{-- <div data-depth="0.05" style="z-index:3;">
                    <img src="{{ asset('assets/img/man_character/kaki-kiri.svg') }}" style="position:relative; left:289px; top:220px;" width="auto" height="auto" alt="">
                </div> --}}

            </div>
        </div>
    </section>

    <section class="section-whitespace" style="padding-top:130px;">
        <div class="section-middle">
            <img src="{{ asset('assets/img/virus.svg') }}" class="virus-floating position-relative virus-sm" width="auto" height="auto" alt="">
            <img src="{{ asset('assets/img/virus.svg') }}" class="virus-floating-slow position-relative virus-md" width="auto" height="350px" alt="">
        </div>
        <div class="row content">
            <div class="col-12 p-0" style="margin-bottom:40px;">
                <h2 class="text-center">
                    <b>Yang harus kamu ketahui</b>
                </h2>
            </div>
            <div class="col-6 p-0 wrap">
                <div class="animation-element fade-in">
                    <h4>
                        <b>Apa Itu COVID-19?</b>
                    </h4>
                    <p class="sub-color sub-text" style=" margin-top: 30px; margin-right: 50px;">
                        Coronavirus Disease 2019 atau COVID-19 adalah penyakit baru yang dapat menyebabkan gangguan pernapasan dan radang paru.
                        Penyakit ini disebabkan oleh infeksi Severe Acute Respiratory Syndrome Coronavirus 2 (SARS-CoV-2).
                        Gejala klinis yang muncul beragam, mulai dari seperti gejala flu biasa (batuk, pilek, nyeri tenggorok,
                        nyeri otot, nyeri kepala) sampai yang berkomplikasi berat (pneumonia atau sepsis).
                    </p>
                </div>
                <div class="animation-element fade-in" style="margin-top:30px;">
                    <h4>
                        <b>Penularan</b>
                    </h4>
                    <p class="sub-color sub-text" style=" margin-top: 30px; margin-right: 50px;">
                        Seseorang dapat terinfeksi dari penderita COVID-19.
                        Penyakit ini dapat menyebar melalui tetesan kecil (droplet) dari hidung atau mulut pada saat batuk atau bersin.
                        Droplet tersebut kemudian jatuh pada benda di sekitarnya.
                        Kemudian jika ada orang lain menyentuh benda yang sudah terkontaminasi dengan droplet tersebut,
                        lalu orang itu menyentuh mata, hidung atau mulut (segitiga wajah), maka orang itu dapat terinfeksi COVID-19.
                        Seseorang juga bisa terinfeksi COVID-19 ketika tanpa sengaja menghirup droplet dari penderita.
                    </p>
                </div>
            </div>
            <div class="col-6 p-0 border-left">
                {{-- <img src="{{ asset('assets/img/corona_virus.svg') }}" class="float-left" width="auto" height="auto" alt=""> --}}
                {{-- <div class="d-flex justify-content-center"> --}}
                    <h4 style="margin-left:50px;">
                        <b>Gejala</b>
                    </h4>
                {{-- </div> --}}
                <div style="margin-left:50px;">
                    <div class="card card-gejala">
                        <img  class="card-img-top" src="{{ asset('assets/img/batuk.svg') }}" width="auto" height="120px" alt="">
                        <div class="card-body-gejala my-auto text-center">
                            <span class="sub-text">Batuk dan Nyeri Tenggorokan</span>
                        </div>
                    </div>
                    <div class="card card-gejala">
                        <img  class="card-img-top" src="{{ asset('assets/img/demam.svg') }}" width="auto" height="120px" alt="">
                        <div class="card-body-gejala my-auto text-center">
                            <span class="sub-text">Demam suhu tinggi / Ada riwayat demam</span>
                        </div>
                    </div>
                    <div class="card card-gejala">
                        <img  class="card-img-top" src="{{ asset('assets/img/sesak.svg') }}" width="auto" height="120px" alt="">
                        <div class="card-body-gejala my-auto text-center">
                            <span class="sub-text">Sesak Napas</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 p-0" style="margin-top:60px;">

            </div>
        </div>
    </section>

    <section class="section-whitespace">
        <div class="row content">
            <div class="col-12 p-0 text-center">
                <h2>
                    <b>Lindungi Diri Kamu dan  Orang Lain</b>
                </h2>
            </div>
            <div class="col-12 p-0 text-center">
                <h4>
                    <b>Hal yang Harus Kamu Lakukan</b>
                </h4>
                <div class="row d-flex justify-content-center"">
                    <div class="col-4 p-0">
                        <div class="card-no-shadow card-data-left">
                            <img  class="card-img-top-rounded" src="{{ asset('assets/img/dirumahaja.svg') }}" width="auto" height="150px" alt="">
                            <div class="card-body-data my-auto text-center">
                                <label class="d-block" style="font-weight:600;">
                                    Dirumah Aja
                                </label>
                                <span class="sub-color">Usahakan tetap di rumah, bekerja dari rumah, belajar dari rumah, dan beribadah di rumah</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 p-0">
                        <div class="card-no-shadow card-data-middle">
                            <img  class="card-img-top-rounded" src="{{ asset('assets/img/higiene.svg') }}" width="auto" height="150px" alt="">
                            <div class="card-body-data my-auto text-center">
                                <label class="d-block" style="font-weight:600;">
                                    Jaga Kebersihanmu
                                </label>
                                <span class="sub-color">Cuci tangan dengan sabun atau gunakan hand sanitizer berbasis alkohol minimal 60% dan bersihkanpermukaan benda yang sering kamu sentuh</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 p-0">
                        <div class="card-no-shadow card-data-right">
                            <img  class="card-img-top-rounded" src="{{ asset('assets/img/etikabersin.svg') }}" width="auto" height="150px" alt="">
                            <div class="card-body-data my-auto text-center">
                                <label class="d-block" style="font-weight:600;">
                                    Terapkan Etika Batuk dan Bersin
                                </label>
                                <span class="sub-color">Tutupi mulut dan hidung saat batuk atau bersin dengan tisu atau siku bagian dalam</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 p-0">
                        <div class="card-no-shadow card-data-middle">
                            <img  class="card-img-top-rounded" src="{{ asset('assets/img/masker.svg') }}" width="auto" height="150px" alt="">
                            <div class="card-body-data my-auto text-center">
                                <label class="d-block" style="font-weight:600;">
                                    Jangan Lupa Gunakan Masker
                                </label>
                                <span class="sub-color">Gunakan masker jika Anda harus beraktivitas di luar rumah dan ganti secara berkala</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 p-0">
                        <div class="card-no-shadow card-data-middle">
                            <img  class="card-img-top-rounded" src="{{ asset('assets/img/hidupsehat.svg') }}" width="auto" height="150px" alt="">
                            <div class="card-body-data my-auto text-center">
                                <label class="d-block" style="font-weight:600;">
                                    Melakukan Pola Hidup Sehat
                                </label>
                                <span class="sub-color">Terapkan pola hidup sehat dengan makanan bergizi dan olahraga</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 p-0 text-center" style="margin-top:30px;">
                <h4>
                    <b>Hal yang Gak Boleh Kamu Lakukan</b>
                </h4>
                <div class="row d-flex justify-content-center"">
                    <div class="col-4 p-0">
                        <div class="card-no-shadow card-data-left">
                            <img  class="card-img-top-rounded" src="{{ asset('assets/img/keluarrumah.svg') }}" width="auto" height="150px" alt="">
                            <div class="card-body-data my-auto text-center">
                                <label class="d-block" style="font-weight:600;">
                                    Keluar Rumah
                                </label>
                                <span class="sub-color">Jangan bepergian ke luar rumah untuk hal yang gak terlalu penting</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 p-0">
                        <div class="card-no-shadow card-data-middle">
                            <img  class="card-img-top-rounded" src="{{ asset('assets/img/ramai.svg') }}" width="auto" height="150px" alt="">
                            <div class="card-body-data my-auto text-center">
                                <label class="d-block" style="font-weight:600;">
                                    Berada Ditempat yang Ramai
                                </label>
                                <span class="sub-color">Jangan berada ditempat ramai, Kamu gak tau siapa disana yang sedang terjangkit virus</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 p-0">
                        <div class="card-no-shadow card-data-right">
                            <img  class="card-img-top-rounded" src="{{ asset('assets/img/sentuhwajah.svg') }}" width="auto" height="150px" alt="">
                            <div class="card-body-data my-auto text-center">
                                <label class="d-block" style="font-weight:600;">
                                    Menyentuh Wajahmu
                                </label>
                                <span class="sub-color">Hindari menyentuh wajahmu terutama pada bagian mata, hidung dan mulut</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="section-whitespace">
        <div class="card content">
            <div class="card-body">
                <div class="row">
                <div class="col-12 p-0">
                    <h2>
                        <b>Dokumen</b>
                    </h2>
                </div>
            </div>
        </div>
    </section>

    <a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button">
        <i class="fas fa-arrow-up"></i>
    </a>
@endsection

@section('custom_script')
<script>
    // $(.corousel).corousel();

    $(document).ready(function() {
        // animation when section in poinview
        var scene = document.getElementById('scene');
        var parallaxInstance = new Parallax(scene);

        var $animation_elements = $('.animation-element');
        var $window = $(window);

        getDataSpread();


        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 4,
            spaceBetween: 30,
            freeMode: true,
            mousewheel: {
                invert: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });


        function check_if_in_view() {
            var window_height = $window.height();
            var window_top_position = $window.scrollTop();
            var window_bottom_position = (window_top_position + window_height);

            $.each($animation_elements, function() {
                var $element = $(this);
                var element_height = $element.outerHeight();
                var element_top_position = $element.offset().top;
                var element_bottom_position = (element_top_position + element_height);

                //check to see if this current container is within viewport
                if ((element_bottom_position >= window_top_position) &&
                    (element_top_position <= window_bottom_position)) {
                $element.addClass('in-view');
                }
                // else {
                // $element.removeClass('in-view');
                // }
            });
        }

        $window.on('scroll resize', check_if_in_view);
        $window.trigger('scroll');

        $window.scroll(function(){
            if ($(window).scrollTop() >= 726) {
                $('.content_header').addClass('fixed-header');
                $('.content_header').removeClass('bg-light');
                // $('nav div').addClass('visible-title');
            }
            else {
                $('.content_header').removeClass('fixed-header');
                $('.content_header').addClass('bg-light');
                // $('nav div').removeClass('visible-title');
            }

            if ($(window).scrollTop() >= 1400) {
                $('#back-to-top').fadeIn();
                // $('nav div').addClass('visible-title');
            }
            else {
                $('#back-to-top').fadeOut();
            }
        });

        $('#back-to-top').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 400);
			return false;
		});
        // ending script animation when section in poinview

        var dataCorona = [];
        var summaryCorona = [];
        var provinceData = JSON.parse('{!! json_encode($newData) !!}');

        function getDataSpread(){
            axios.get('https://indonesia-covid-19.mathdro.id/api/provinsi').then((res) =>{
                var tempArray = [];
                var tempSummary = {
                    'kasusPosi':0,
                    'kasusSemb':0,
                    'kasusMeni':0
                };
                $.each(res.data.data, (k, v) => {
                    tempArray[v.provinsi] = v;
                    tempSummary.kasusPosi+=v.kasusPosi;
                    tempSummary.kasusSemb+=v.kasusSemb;
                    tempSummary.kasusMeni+=v.kasusMeni;
                });

                summaryCorona = (tempSummary)
                dataCorona = (tempArray)

                $.each($('.provinceSelector'), (k, v) => {
                    if($(v).html() == "Indonesia"){
                        $(v).parent().addClass('card-location-active');
                    }
                });

                $("#txt_konfirm").html(summaryCorona.kasusPosi);
                $("#txt_meninggal").html(summaryCorona.kasusMeni);
                $("#txt_sembuh").html(summaryCorona.kasusSemb);

                counterAnimation();
            });
        }

        $('.provinceSelector').click((e) => {

            $('.card-location').removeClass('card-location-active');
            $(e.target.parentElement).addClass('card-location-active');

            var finalResut = dataCorona[e.target.innerText];

            if(e.target.innerText == 'Indonesia'){
                finalResut = summaryCorona;
            }

            console.log(e.target.innerText);


            $("#call_center_nam").html(provinceData[e.target.innerText].call_center_name);
            $("#hotline_name").html(provinceData[e.target.innerText].hotline_name);
            $("#call_center_number").html(provinceData[e.target.innerText].call_center_number.replace(/\-/g, ' '));
            $("#hot_line_number").html(provinceData[e.target.innerText].hotline_number.replace(/\-/g, ' '));
            $("#card_call_center").attr(provinceData[e.target.innerText].call_center_number);
            // alert($("#card_hotline").attr("href",provinceData[e.target.innerText].call_center_number))
            $("#txt_konfirm").text(finalResut.kasusPosi);
            $("#txt_meninggal").text(finalResut.kasusMeni);
            $("#txt_sembuh").text(finalResut.kasusSemb);

            counterAnimation();
        });

        $('#card_call_center').click((e) => {
            console.log($('#call_center_number').text());

            document.location.href = 'tel:'+$('call_center_number').text
        });

        function counterAnimation() {
            $('.count').each(function () {
                $(this).prop('Counter',0).animate({
                    Counter: $(this).text()
                }, {
                    duration: 375,
                    easing: 'swing',
                    step: function (now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });
        }

    });


</script>
@endsection
