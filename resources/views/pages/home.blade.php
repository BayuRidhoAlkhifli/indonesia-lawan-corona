@extends('layout.hero')

@section('content')

    <section class="section-top-content">
        <!-- BEGIN PlACE PAGE CONTENT HERE -->
            <div class="row content content-sm">
                <picture style="position: absolute;width: 100%;top: 0;left: 0;">
                    <source media="(max-width:375px)" srcset="{{ asset ('assets/img/wave_white_375.svg') }}">
                    <source media="(min-width: 425px)" srcset="{{ asset ('assets/img/wave_white_425.svg') }}">
                    <img src="{{ asset('assets/img/wave_white_425.svg') }}" class="bg-top" alt="">
                </picture>
                <div class="col-lg-8 col-md-12 col- p-0 mt-15">
                    <div id="carouselExampleIndicators" class="carousel slide" style="width:100%; height:auto;" data-ride="carousel">

                        <div class="carousel-inner corousel-lg">
                            <div class="carousel-item active">
                                <picture>
                                    <source media="(max-width: 988px)" srcset="{{ asset ('assets/img/test_masif-hd.svg') }}">
                                    <source media="(min-width: 1024px)" srcset="{{ asset ('assets/img/test_masif.svg') }}">
                                    <img class="d-block w-100" src="{{ asset ('assets/img/test_masif.svg') }}" alt="First slide">
                                </picture>
                            
                            </div>
                            <div class="carousel-item">
                                <picture>
                                    <source media="(max-width: 988px)" srcset="{{ asset ('assets/img/relawan-hd.svg') }}">
                                    <source media="(min-width: 1024px)" srcset="{{ asset ('assets/img/relawan.svg') }}">
                                    <img class="d-block w-100" src="{{ asset ('assets/img/relawan.svg') }}" alt="Second slide">
                                </picture>
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
                <div class="col-lg-4 col-md-12 call-content mt-15">
                    <div class="row h-100 grid-container">
                        <div class="col-lg-12 card-pr-15">
                            <div id="card_call_center" class="card h-100 card-call" style="cursor: pointer" data-container="body" data-toggle="popover" data-placement="right" data-content="Klik untuk menelpon">
                                <div class="card-body">
                                    <div class="call-center-header">
                                        <div>
                                            <span id="call_center_name" class="d-block main-title">{{ $locations[0]->call_center_name}}</span>
                                            <span class="d-block sub-title">Nomor Darurat</span>
                                        </div>
                                    </div>
                                    <div class="call-center-body">
                                        <img src="{{ asset('assets/img/callcenter-icon.svg') }}" class="number-call-icon" alt="">
                                        <a id="call_center_number">{{ str_replace("-"," ", $locations[0]->call_center_number)}}</a>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-cpy cpy-call-center" data-clipboard-target="#call_center_number" onclick="toastMessage()">Salin Nomor</button>
                        </div>
                        <div class="col-lg-12 card-pl-15">
                            <div id="card_hotline" class="card h-100 card-call" style="cursor: pointer" data-container="body" data-toggle="popover" data-placement="right" data-content="Klik untuk menelpon">
                                <div class="card-body">
                                    <div class="call-center-header row m-0">
                                        <div>
                                            <span id="hotline_name"  class="d-block main-title">{{ $locations[0]->hotline_name}}</span>
                                            <span class="d-block sub-title">Pertanyaan Umum</span>
                                        </div>
                                    </div>
                                    <div class="call-center-body">
                                        <img src="{{ asset('assets/img/callcenter-icon.svg') }}" class="number-call-icon" alt="">
                                        <a id="hot_line_number">{{ str_replace("-"," ", $locations[0]->hotline_number)}}</a>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-cpy cpy-hotline" data-clipboard-target="#hot_line_number" onclick="toastMessage()">Salin Nomor</button>
                        </div>
                    </div>
                </div>
            </div>


        <!-- END PLACE PAGE CONTENT HERE -->
    </section>

    <section class="padding-section">
        <div class="row content">
            {{-- <div class="col-md-12 p-0 text-right content-sm sub-title">
                <label class="cstm-switch ">
                    <span class="cstm-switch-description mr-3 text-left">Urutkan Provinsi Berdasarkan Kasus Terkonfirmasi</span>
                    <input id="filter_by_posi" type="checkbox" required="" name="option" value="1" class="cstm-switch-input">
                    <span class="cstm-switch-indicator size-lg "></span>
                </label>
            </div> --}}
            <div id="input_search" class="col-lg-12 col-md-12 p-0 input-bg border-radius-10 content-sm mt-30">
                <div class="input-group my-15">
                    <div class="input-group-prepend show-content-sm">
                        <span class="input-group-text icon-left-padding">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                    <input id="province_finder" type="search" class="form-control input-bg search-input" placeholder="Cari provinsi" onfocus="this.value=''">
                    <div class="input-group-append show-content-lg">
                        <span class="input-group-text icon-right-padding">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-12 p-0">
                <div class="swiper-container swiper-province swiper-p search-not-found">
                    <div class="swiper-wrapper">
                        @php
                            $val = 0;
                        @endphp
                            <div class="swiper-slide swiper-slide-active" style="width: auto; margin-right: 25px;">
                                <div class="card card-location" style="cursor:pointer">
                                    <div class="card-province text-center provinceSelector">Indonesia</div>
                                </div>
                            </div>
                        @foreach ($locations as $key)
                            @if ($locations[$val]->name != "Indonesia")
                                <div class="swiper-slide swiper-slide-active" style="width: auto; margin-right: 25px;">
                                    <div class="card card-location" style="cursor:pointer">
                                        <div class="card-province text-center provinceSelector">{{ $locations[$val]->name }}</div>
                                    </div>
                                </div>
                            @endif
                            @php
                                $val++;
                            @endphp
                        @endforeach
                    </div>

                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev sbp-province"></div>
                    <div class="swiper-button-next sbn-province"></div>

                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                </div>
                <div id="alert_search" role="alert">
                    <div class="col-auto p-0" id="icon-alert-search">
                        
                    </div>
                    <div id="alert-search-not-found" class="col-10">
                        
                    </div>
                </div>
            </div>
            {{-- @dump($hospitalData) --}}
            <div class="col-md-12 p-0 mt-30">
                <div class="row slider slider-nav search-not-found content-sm">
                    <div class="col-md-3 p-0 data-kasus text-center">
                        <h4>
                            Data Kasus
                        </h4>
                    </div>
                    <div class="col-md-3 p-0 rs-rujukan text-center">
                        <h4>
                            RS Rujukan
                        </h4>
                    </div>
                </div>
                <div class="row slider slider-for search-not-found">
                    <div id="data_kasus" class="col-md-12 content-sm mt-20 search-not-found">
                        <label class="sub-color animation-element fade-in sub-title" style="font-weight: 400;">
                            Pembaharuan Terakhir: <span id="updated_at"></span>
                        </label>
                        <div class="row">
                            <div class="col-md-4 p-0 ">
                                <div class="card card-data card-data-left animation-element slide-bottom">
                                    <div class="card-body-data wrap">
                                        <div class=" whitespace-data-left mt-0">
                                            <span class="d-block main-title-md">TERKONFIRMASI</span>
                                            <div>
                                                <span id="txt_confirm" class="color-orange data-angka count">-</span>
                                                <div class="increase-val-1 increase-val-data increase-val">
                                                    <i class="fas fa-arrow-up"></i>
                                                    <span id="txt_confirm_increase" class="txt_increase">0</span>
                                                </div>
                                            </div>
                                            <div class="idn-data">
                                                <span id="txt_confirm_idn" class="color-orange sub-data-angka">-</span>
                                                <span class="sub-color">Dari total kasus</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 p-0">
                                <div class="card card-data card-data-middle animation-element slide-bottom-dly-135s">
                                    <div class="card-body-data wrap">
                                        <div class=" whitespace-data-left mt-0">
                                            <span class="d-block main-title-md" >SEMBUH</span>
                                            <span id="txt_cured" class="color-green data-angka count">-</span>
                                            <div class="increase-val-3 increase-val-data increase-val">
                                                <i class="fas fa-arrow-up"></i>
                                                <span id="txt_cured_increase" class="txt_increase">0</span>
                                            </div>
                                            <div class="idn-data">
                                                <span id="txt_cured_idn" class="color-green sub-data-angka" style="opacity: 1;">-</span>
                                                <span class="sub-color">Dari total kasus</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 p-0">
                                <div class="card card-data card-data-right animation-element slide-bottom-dly-145s">
                                    <div class="card-body-data wrap">
                                        <div class=" whitespace-data-left mt-0">
                                            <span class="d-block main-title-md" >MENINGGAL</span>
                                            <span id="txt_death" class="color-purple data-angka count">-</span>
                                            <div class="increase-val-2 increase-val-data increase-val">
                                                <i class="fas fa-arrow-up"></i>
                                                <span id="txt_death_increase" class="txt_increase">0</span>
                                            </div>
                                            <div class="idn-data">
                                                <span id="txt_death_idn" class="color-purple sub-data-angka">-</span>
                                                <span class="sub-color">Dari total kasus</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 p-0 text-right mt-10">
                                <a href="{{ route("dataPage") }}" class="link-purple">
                                    Lihat Data Statistik <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div id="rs_rujukan" class="col-md-12 p-0 content-sm mt-20 search-not-found">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <div>
                                <h4>Peringatan!</h4>
                            </div>
                            <div>
                                Sebelum kamu menuju rumah sakit, terlebih dahulu hubungi call center <a href="tel: 119">119</a> dan lakukan verifikasi rumah sakit.
                            </div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="tbl-hospital">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Rumah Sakit</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="table_hospital">
                                    
                                </tbody>
                            </table>
                        </div>
                        <div id="card_hospital" class="row m-0 card-hospital">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-whitespace">
        <div class="row content py-30">
            <div class="col-lg-6 col-md-12 p-0 content-sm">
                <h2>
                    <b>Risiko dari COVID-19</b>
                </h2>
                <p class="sub-color sub-text mt-30 mr-50">
                    COVID-19 merupakan penyakit yang disebabkan Novel Coronavirus 2019.
                    Meski bergejala mirip dengan flu biasa, COVID-19 sampai saat ini memiliki fatalitas lebih tinggi.
                    Virus ini juga menyebar dengan sangat cepat karena bisa pindah dari orang ke orang bahkan sebelum orang tersebut menunjukkan gejala.
                    <br><br>Penting bagi kamu untuk menilai kondisi secara mandiri. Apa kamu bergejala?
                </p>
                <a href="https://prixa.ai/corona" class="btn btn-outline-purple animation-element fade-in" role="button" target="_blank">
                    Periksa Mandiri
                </a>
            </div>
            <div id="scene" class="col-lg-6 col-md-12 p-0" style="margin-top: 10px">
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

    <section class="section-whitespace section-middle" style="padding-top:130px;">
        <div class="">
            <div class="w-100 position-relative">
                <img src="{{ asset('assets/img/virus.svg') }}" class="virus-floating position-absolute virus-sm" width="auto" height="auto" alt="">
                <img src="{{ asset('assets/img/virus.svg') }}" class="virus-floating-slow position-absolute virus-md" width="auto" height="350px" alt="">
            </div>
        </div>
        <div class="row content py-30">
            <div class="col-md-12 p-0 content-sm mt-custm">
                <h2 class="text-center">
                    <b>Yang harus kamu ketahui</b>
                </h2>
            </div>
            <div class="col-lg-6 col-md-12 p-0 wrap content-sm">
                <div class="animation-element fade-in">
                    <h4>
                        <b>Apa Itu COVID-19?</b>
                    </h4>
                    <p class="sub-color sub-text mt-30 mr-50">
                        Coronavirus Disease 2019 atau COVID-19 adalah penyakit baru yang dapat menyebabkan gangguan pernapasan dan radang paru.
                        Penyakit ini disebabkan oleh infeksi Severe Acute Respiratory Syndrome Coronavirus 2 (SARS-CoV-2).
                        Gejala klinis yang muncul beragam, mulai dari seperti gejala flu biasa (batuk, pilek, nyeri tenggorok,
                        nyeri otot, nyeri kepala) sampai yang berkomplikasi berat (pneumonia atau sepsis).
                    </p>
                </div>
                <div class="animation-element fade-in mt-30">
                    <h4>
                        <b>Penularan</b>
                    </h4>
                    <p class="sub-color sub-text mt-30 mr-50">
                        Seseorang dapat terinfeksi dari penderita COVID-19.
                        Penyakit ini dapat menyebar melalui tetesan kecil (droplet) dari hidung atau mulut pada saat batuk atau bersin.
                        Droplet tersebut kemudian jatuh pada benda di sekitarnya.
                        Kemudian jika ada orang lain menyentuh benda yang sudah terkontaminasi dengan droplet tersebut,
                        lalu orang itu menyentuh mata, hidung atau mulut (segitiga wajah), maka orang itu dapat terinfeksi COVID-19.
                        Seseorang juga bisa terinfeksi COVID-19 ketika tanpa sengaja menghirup droplet dari penderita.
                    </p>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 p-0 border-left">
                {{-- <img src="{{ asset('assets/img/corona_virus.svg') }}" class="float-left" width="auto" height="auto" alt=""> --}}
                <div class="content-sm">
                    <h4 class="ml-50 content-sm">
                        <b>Gejala</b>
                    </h4>
                </div>
                <div class="ml-50 card-gjl grid-gjl show-content-lg content-sm">
                    <div class="card card-gejala">
                        <img  class="card-img-top" src="{{ asset('assets/img/batuk.svg') }}" width="auto" height="120px" alt="">
                        <div class="card-body-gejala my-auto text-center">
                            <span class="sub-text">Batuk dan Nyeri Tenggorokan</span>
                        </div>
                    </div>
                    <div class="card card-gejala">
                        <img  class="card-img-top" src="{{ asset('assets/img/demam.svg') }}" width="auto" height="120px" alt="">
                        <div class="card-body-gejala my-auto text-center">
                            <span class="sub-text">Demam suhu tinggi</span>
                        </div>
                    </div>
                    <div class="card card-gejala">
                        <img  class="card-img-top" src="{{ asset('assets/img/sesak.svg') }}" width="auto" height="120px" alt="">
                        <div class="position-relative my-auto text-center">
                            <span class="sub-text">Sesak Napas</span>
                        </div>
                    </div>
                </div>
                <div class="swiper-container swiper-p swiper-gjl show-content-sm">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="card card-gejala">
                                <img  class="card-img-top position-absolute" src="{{ asset('assets/img/batuk-sm.svg') }}" width="auto" height="275px" alt="">
                                <div class="position-relative text-center space-txt-gjl">
                                    <span class="sub-text">Batuk dan Nyeri Tenggorokan</span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card card-gejala">
                                <img  class="card-img-top position-absolute" src="{{ asset('assets/img/demam-sm.svg') }}" width="auto" height="275px" alt="">
                                <div class="position-relative text-center space-txt-gjl">
                                    <span class="sub-text">Demam suhu tinggi</span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card card-gejala">
                                <img  class="card-img-top position-absolute" src="{{ asset('assets/img/sesak-sm.svg') }}" width="auto" height="275px" alt="">
                                <div class="position-relative text-center space-txt-gjl">
                                    <span class="sub-text">Sesak Napas</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-whitespace">
        <div class="row content">
            <div class="col-md-12 p-0 text-center content-sm mt-custm">
                <h2>
                    <b>Lindungi Diri Kamu dan  Orang Lain</b>
                </h2>
            </div>
            <div class="col-md-12 p-0 text-center">
                <h4>
                    <b>Hal yang Harus Kamu Lakukan</b>
                </h4>
                <div class="row justify-content-center show-content-lg">
                    <div class="col-lg-4 col-md-6 p-0">
                        <div class="card-no-shadow step-item-1">
                            <img  class="card-img-top-rounded" src="{{ asset('assets/img/dirumahaja.svg') }}" width="auto" height="150px" alt="">
                            <div class="card-body-data my-auto text-center">
                                <label class="d-block" style="font-weight:600;">
                                    Dirumah Aja
                                </label>
                                <span class="sub-color">Usahakan tetap di rumah, bekerja dari rumah, belajar dari rumah, dan beribadah di rumah</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 p-0">
                        <div class="card-no-shadow step-item-2">
                            <img  class="card-img-top-rounded" src="{{ asset('assets/img/higiene.svg') }}" width="auto" height="150px" alt="">
                            <div class="card-body-data my-auto text-center">
                                <label class="d-block" style="font-weight:600;">
                                    Jaga Kebersihanmu
                                </label>
                                <span class="sub-color">Cuci tangan dengan sabun atau gunakan hand sanitizer berbasis alkohol minimal 60% dan bersihkanpermukaan benda yang sering kamu sentuh</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 p-0">
                        <div class="card-no-shadow step-item-3">
                            <img  class="card-img-top-rounded" src="{{ asset('assets/img/etikabersin.svg') }}" width="auto" height="150px" alt="">
                            <div class="card-body-data my-auto text-center">
                                <label class="d-block" style="font-weight:600;">
                                    Terapkan Etika Batuk dan Bersin
                                </label>
                                <span class="sub-color">Tutupi mulut dan hidung saat batuk atau bersin dengan tisu atau siku bagian dalam</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 p-0">
                        <div class="card-no-shadow step-item-4">
                            <img  class="card-img-top-rounded" src="{{ asset('assets/img/masker.svg') }}" width="auto" height="150px" alt="">
                            <div class="card-body-data my-auto text-center">
                                <label class="d-block" style="font-weight:600;">
                                    Gak Lupa Gunakan Masker
                                </label>
                                <span class="sub-color">Gunakan masker jika Kamu harus beraktivitas di luar rumah dan ganti secara berkala</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 p-0">
                        <div class="card-no-shadow step-item-5">
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
                <div class="swiper-container swiper-1 show-content-sm">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="card-no-shadow step-item-2">
                                <img  class="card-img-top-rounded" src="{{ asset('assets/img/dirumahaja.svg') }}" width="auto" height="150px" alt="">
                                <div class="card-body-data my-auto text-center">
                                    <label class="d-block" style="font-weight:600;">
                                        Dirumah Aja
                                    </label>
                                    <span class="sub-color">Usahakan tetap di rumah, bekerja dari rumah, belajar dari rumah, dan beribadah di rumah</span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card-no-shadow step-item-2">
                                <img  class="card-img-top-rounded" src="{{ asset('assets/img/higiene.svg') }}" width="auto" height="150px" alt="">
                                <div class="card-body-data my-auto text-center">
                                    <label class="d-block" style="font-weight:600;">
                                        Jaga Kebersihanmu
                                    </label>
                                    <span class="sub-color">Cuci tangan dengan sabun atau gunakan hand sanitizer berbasis alkohol minimal 60% dan bersihkanpermukaan benda yang sering kamu sentuh</span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card-no-shadow step-item-2">
                                <img  class="card-img-top-rounded" src="{{ asset('assets/img/etikabersin.svg') }}" width="auto" height="150px" alt="">
                                <div class="card-body-data my-auto text-center">
                                    <label class="d-block" style="font-weight:600;">
                                        Terapkan Etika Batuk dan Bersin
                                    </label>
                                    <span class="sub-color">Tutupi mulut dan hidung saat batuk atau bersin dengan tisu atau siku bagian dalam</span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card-no-shadow step-item-2">
                                <img  class="card-img-top-rounded" src="{{ asset('assets/img/masker.svg') }}" width="auto" height="150px" alt="">
                                <div class="card-body-data my-auto text-center">
                                    <label class="d-block" style="font-weight:600;">
                                        Gak Lupa Gunakan Masker
                                    </label>
                                    <span class="sub-color">Gunakan masker jika Kamu harus beraktivitas di luar rumah dan ganti secara berkala</span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card-no-shadow step-item-2">
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
                    <div class="swiper-button-next sbn-1"></div>
                    <div class="swiper-button-prev sbp-1"></div>
                </div>
            </div>
            <div class="col-md-12 p-0 text-center mt-30">
                <h4>
                    <b>Hal yang Gak Boleh Kamu Lakukan</b>
                </h4>
                <div class="row justify-content-center show-content-lg">
                    <div class="col-lg-4 col-md-6 p-0">
                        <div class="card-no-shadow step-item-1">
                            <img  class="card-img-top-rounded" src="{{ asset('assets/img/keluarrumah.svg') }}" width="auto" height="150px" alt="">
                            <div class="card-body-data my-auto text-center">
                                <label class="d-block" style="font-weight:600;">
                                    Keluar Rumah
                                </label>
                                <span class="sub-color">Gak bepergian ke luar rumah untuk hal yang gak terlalu penting</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 p-0">
                        <div class="card-no-shadow step-item-2">
                            <img  class="card-img-top-rounded" src="{{ asset('assets/img/ramai.svg') }}" width="auto" height="150px" alt="">
                            <div class="card-body-data my-auto text-center">
                                <label class="d-block" style="font-weight:600;">
                                    Berada Ditempat yang Ramai
                                </label>
                                <span class="sub-color">Gak berada ditempat ramai, Kamu gak tau siapa disana yang sedang terjangkit virus</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 p-0">
                        <div class="card-no-shadow step-item-3">
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
                <div class="swiper-container swiper-2 show-content-sm">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="card-no-shadow step-item-2">
                                <img  class="card-img-top-rounded" src="{{ asset('assets/img/keluarrumah.svg') }}" width="auto" height="150px" alt="">
                                <div class="card-body-data my-auto text-center">
                                    <label class="d-block" style="font-weight:600;">
                                        Keluar Rumah
                                    </label>
                                    <span class="sub-color">Gak bepergian ke luar rumah untuk hal yang gak terlalu penting</span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card-no-shadow step-item-2">
                                <img  class="card-img-top-rounded" src="{{ asset('assets/img/ramai.svg') }}" width="auto" height="150px" alt="">
                                <div class="card-body-data my-auto text-center">
                                    <label class="d-block" style="font-weight:600;">
                                        Berada Ditempat yang Ramai
                                    </label>
                                    <span class="sub-color">Gak berada ditempat ramai, Kamu gak tau siapa disana yang sedang terjangkit virus</span>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="card-no-shadow step-item-2">
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
                    <div class="swiper-button-next sbn-2"></div>
                    <div class="swiper-button-prev sbp-2"></div>
                </div>
            </div>
        </div>
    </section>
    <div id="snackbar">
        Nomor Berhasil Disalin
    </div>
    <div class="back-to-top text-center">
        <a id="back-to-top" href="#" class="btn btn-light btn-lg" role="button">
            <i class="fas fa-arrow-up"></i>
        </a>
    </div>
    
@endsection

@section('custom_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
<script>

    $('img').bind('contextmenu', function(e) {
        return false;
    }); 

    var last_selected = $(".provinceSelector:contains('Indonesia')");

    var swiper_province = {};
    var swiper_gjl = {};
    var swiper1 = {};
    var swiper2 = {};

    var scene = document.getElementById('scene');
    var parallaxInstance = new Parallax(scene);

    var $animation_elements = $('.animation-element');
    var $window = $(window);
    var prev = 0;

    var placeHolder = ['Cari provinsi', 'Misal Papua, Jawa Timur, dll'];
    var arrayPlaceHolder = 0;
    var loopLength = placeHolder.length;

    var dataPosiNow = 0;
    var dataCuredNow = 0;
    var dataDeathNow = 0;

    var switchStatus = false;

    new ClipboardJS('.cpy-hotline');
    new ClipboardJS('.cpy-call-center');

    $(document).ready(function() {
        // animation when section in poinview
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
                $('.back-to-top').fadeIn();
                // $('nav div').addClass('visible-title');
            }
            else {
                $('.back-to-top').fadeOut();
            }
        });

        // ending script animation when section in poinview

        setInterval(() => {
            if(arrayPlaceHolder<loopLength){
                var newPlaceholder = placeHolder[arrayPlaceHolder];
                arrayPlaceHolder++;
                $('#province_finder').attr('placeholder',newPlaceholder);
            } else {
                $('#province_finder').attr('placeholder',placeHolder[0]);
                arrayPlaceHolder = 0;
            }
        }, 4000);

        getDataSpread();

        swiper_province = new Swiper('.swiper-province', {
            slidesPerView: 4,
            spaceBetween: 30,
            freeMode: true,
            slideToClickedSlide: true,
            mousewheel: {
                invert: true,
            },
            navigation: {
                nextEl: '.sbn-province',
                prevEl: '.sbp-province',
            },
            breakpoints: {
                320:{
                    slidesPerView: 1.9,
                    spaceBetween: 15,
                },
                375: {
                    slidesPerView: 2.2,
                    spaceBetween: 15,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
            }
        });

        swiper_gjl = new Swiper('.swiper-gjl', {
            slidesPerView: 1.5,
            spaceBetween:20,
            centeredSlides: false
        });

        swiper1 = new Swiper('.swiper-1', {
            spaceBetween:30,
            centeredSlides: true,
            navigation: {
                nextEl: '.sbn-1',
                prevEl: '.sbp-1',
            },
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
        });

        swiper2 = new Swiper('.swiper-2', {
            spaceBetween:30,
            centeredSlides: true,
            navigation: {
                nextEl: '.sbn-2',
                prevEl: '.sbp-2',
            },
            autoplay: {
                delay: 4500,
                disableOnInteraction: false,
            },
        });

        $("#filter_by_posi").on('change', function() {
            if ($(this).is(':checked')) {
                switchStatus = $(this).is(':checked');
                alert(switchStatus);// To verify
            }
            else {
            switchStatus = $(this).is(':checked');
            alert(switchStatus);// To verify
            }
        });

        $('#back-to-top').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 400);
			return false;
		});

        var dataCorona = [];
        var hospitalData = '';
        var oldCaseData = [];
        var caseIncrease = 0;
        
        function getDataSpread(){
            axios.get('{{ route("get.dataSpread") }}').then((res) => {
                moment.locale("id");
                var tempArrayCase = [];
                var tempOldArrayCase = [];
                hospitalData = res.data.hospitalData;

                $.each(res.data.dataSpread, (k, v) => {
                    tempArrayCase[v.name] = v;
                });

                $.each(res.data.oldDataSpread, (k, v) => {
                    tempOldArrayCase[v.loc_name] = v;
                });

                // console.log(res.data);
                
                dataCorona  = (tempArrayCase);
                oldCaseData = (tempOldArrayCase);

                $.each($('.provinceSelector'), (k, v) => {
                    vHtml = $(v).html();
                    
                    if(vHtml == "Indonesia"){
                        $(v).parent().addClass('card-active');
                        $('.rs-rujukan').addClass('d-none');
                        $('#rs_rujukan').addClass('d-none');
                        $('.idn-data').addClass('d-none');
                        $('.data-angka').addClass('d-block');
                        $('.increase-val-data').addClass('top-0');
                        $('.slider-for').slick("slickSetOption", "accessibility", false);
                        $('.slider-for').slick("slickSetOption", "draggable", false);
                        $('.slider-for').slick("slickSetOption", "swipe", false);
                        $('.slider-for').slick("slickSetOption", "touchMove", false);
                        $('.slider-for').find(".slick-list").height("auto");
                        // $('.slider-for').slickSetOption(null, null, true);
                        // $('.slider-for').slick("slickSetOption", null, null, false);
                    }

                    $(v).data("real", vHtml);
                    if(vHtml == "Kepulauan Bangka Belitung"){
                        $(v).data("real", "Kepulauan Bangka Belitung");
                        $(v).html("Bangka Belitung");
                    }else if(vHtml == "Daerah Istimewa Yogyakarta"){
                        $(v).data("real", "Daerah Istimewa Yogyakarta");
                        $(v).html("DI Yogyakarta");
                    }else if(vHtml == "Nusa Tenggara Barat"){
                        $(v).data("real", "Nusa Tenggara Barat");
                        $(v).html("NTB");
                    }else if(vHtml == "Nusa Tenggara Timur"){
                        $(v).data("real", "Nusa Tenggara Timur");
                        $(v).html("NTT");
                    }
                });

                

                dataPosiNow = dataCorona["Indonesia"].positive - oldCaseData["Indonesia"].positive;
                dataCuredNow = dataCorona["Indonesia"].cured - oldCaseData["Indonesia"].cured;
                dataDeathNow = dataCorona["Indonesia"].death - oldCaseData["Indonesia"].death;

                if (dataPosiNow == 0) {
                    dataPosiNow = "-";
                }
                if(dataCuredNow == 0) {
                    dataCuredNow = "-";
                }
                if(dataDeathNow == 0) {
                    dataDeathNow = "-";
                }
                
                // console.log(res.data.oldDataSpread);
                $("#updated_at").html(moment(dataCorona["Indonesia"].updated_at).format("dddd,  DD MMMM YYYY HH:mm"));
                $("#txt_confirm").html(dataCorona["Indonesia"].positive);
                $("#txt_death").html(dataCorona["Indonesia"].death);
                $("#txt_cured").html(dataCorona["Indonesia"].cured);
                $("#txt_confirm_increase").html(dataPosiNow.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
                $("#txt_death_increase").html(dataDeathNow.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
                $("#txt_cured_increase").html(dataCuredNow.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));

                counterAnimation();
            });
        };

        // $('#province_finder').on('focus', function() {
        //     $('#alert_search').removeAttr('class');
        //     $('#icon-alert-search').html('');
        //     $('#alert-search-not-found').html('');
        //     $('.search-not-found').removeClass('d-none');
        //     $('#province_finder').val() == '';
        // });

        $('#province_finder').keypress((e) => {
            provinceFinder(e);
        })

        $('#province_finder').on('input', function() {
            if ($('#province_finder').val() == ''){
                $('#alert_search').removeAttr('class');
                $('#icon-alert-search').html('');
                $('#alert-search-not-found').html('');
                $('.search-not-found').removeClass('d-none');
            }

            $(last_selected).parent().addClass('card-active'); 
            
        });

        $('.provinceSelector').click((e) => {
            
            var arrayKey = $(e.target).data("real");
            
            var finalResultData = dataCorona[arrayKey];
            var finalResultOldData = oldCaseData[arrayKey];
            
            $('.card-location').removeClass('card-active');
            $(e.target.parentElement).addClass('card-active');

            var hospitalCollection = [];
            var c = 0;
            var tableHospital = '';
            var cardHospital = '';
            
            $.each(hospitalData, (k, v) => {
                if(v.loc_name == arrayKey){
                    
                    c++;

                    tableHospital +=`<tr>
                                        <td>`+ c+`</td>
                                        <td>`+ v.name_hospital +`</td>
                                        <td>`+ v.address +`</td>
                                        <td><a href="`+ v.link_map +`" class="btn btn-outline-purple mt-0" target="_blank">Lihat Peta</a></td>
                                    </tr>`;

                    cardHospital +=`<div class="col-md-12 p-0 mb-15">
                                        <div class="card card-data m-0">
                                            <div class="card-body">
                                                <div class ="col-md-12 p-0 my-15 mt-0">
                                                    <h5 class="card-title">`+ v.name_hospital +`</h5>
                                                    <p class="card-text sub-color">`+ v.address +`</p>
                                                </div>
                                                <a href="`+ v.link_map +`" class="btn btn-purple w-100 mt-0" target="_blank">Lihat Peta</a>
                                            </div>
                                        </div>
                                    </div>`;
                    // hospitalCollection[c] = v;
                    
                }
            })
            
            if(arrayKey == 'Indonesia'){
                $('.rs-rujukan').addClass('d-none');
                $('#rs_rujukan').addClass('d-none');
                $('.idn-data').addClass('d-none');
                $('.data-angka').addClass('d-block');
                $('.increase-val-data').addClass('top-0');
                // $('.slider-for').slick("slickSetOption", "accessibility", false);
                // $('.slider-for').slick("slickSetOption", "draggable", false);
                // $('.slider-for').slick("slickSetOption", "swipe", false);
                // $('.slider-for').slick("slickSetOption", "touchMove", false);
                // $('.slider-for').slick("slickSetOption", "adaptiveHeight", false);
                // $('.slider-for').find(".slick-list").height("auto");
                // $('.slider-for').slick("slickSetOption", null, null, false);
            }else{
                $('.rs-rujukan').removeClass('d-none');
                $('#rs_rujukan').removeClass('d-none');
                $('.idn-data').addClass('mb-5px');
                $('.idn-data').removeClass('d-none');
                $('.data-angka').removeClass('d-block');
                $('.increase-val-data').removeClass('top-0');
                // $('.slider-for').slick("slickSetOption", "accessibility", true);
                // $('.slider-for').slick("slickSetOption", "draggable", true);
                // $('.slider-for').slick("slickSetOption", "swipe", true);
                // $('.slider-for').slick("slickSetOption", "touchMove", true);
                // $('.slider-for').find(".slick-list").height("auto");
                // $('.slider-for').slick("slickSetOption", null, null, false);
            };

            persentaseOfTotalPosi = finalResultData.positive/dataCorona["Indonesia"].positive*100;
            persentaseOfTotalCured = finalResultData.cured/dataCorona["Indonesia"].cured*100;
            persentaseOfTotalDeath = finalResultData.death/dataCorona["Indonesia"].death*100;

            dataPosiNow = finalResultData.positive - finalResultOldData.positive;
            dataCuredNow = finalResultData.cured - finalResultOldData.cured;
            dataDeathNow = finalResultData.death - finalResultOldData.death;

            if (dataPosiNow == 0) {
                dataPosiNow = "-";
            }
            if(dataCuredNow == 0) {
                dataCuredNow = "-";
            }
            if(dataDeathNow == 0) {
                dataDeathNow = "-";
            }

            // console.log(dataCorona)
            $("#table_hospital").html(tableHospital);
            $("#card_hospital").html(cardHospital);
            $("#call_center_nam").html(dataCorona[arrayKey].call_center_name);
            $("#hotline_name").html(dataCorona[arrayKey].hotline_name);
            $("#call_center_number").html(dataCorona[arrayKey].call_center_number.replace(/\-/g, ' '));
            $("#hot_line_number").html(dataCorona[arrayKey].hotline_number.replace(/\-/g, ' '));
            // $("#card_call_center").attr(provinceData[arrayKey].call_center_number);
            // alert($("#card_hotline").attr("href",provinceData[arrayKey].call_center_number))
            
            
            $("#txt_confirm").text(finalResultData.positive);
            $("#txt_cured").text(finalResultData.cured);
            $("#txt_death").text(finalResultData.death);
            $("#txt_confirm_idn").html(persentaseOfTotalPosi.toFixed(2).toString().replace(/\./g, ",")+"%");
            $("#txt_cured_idn").html(persentaseOfTotalCured.toFixed(2).toString().replace(/\./g, ",")+"%");
            $("#txt_death_idn").html(persentaseOfTotalDeath.toFixed(2).toString().replace(/\./g, ",")+"%");
            $("#txt_confirm_increase").text(dataPosiNow.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
            $("#txt_death_increase").text(dataDeathNow.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
            $("#txt_cured_increase").text(dataCuredNow.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));

            counterAnimation();
        });

        $('#card_call_center').click((e) => {
            document.location.href = 'tel:'+dataCorona[$('.card-active').children().html()].call_center_number;
        });

        $('#card_hotline').click((e) => {
            document.location.href = 'tel:'+dataCorona[$('.card-active').children().html()].hotline_number;
        });

        $('.slider-nav').slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: false,
            centerMode: false,
            focusOnSelect: true,
            mobileFirst: true,
            swipeTswipeoSlide: false,
            speed: 500
        });

        $('.slider-for').slick({
            mobileFirst: true,
            infinite: false,
            centerMode: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: false,
            asNavFor: '.slider-nav',
            speed: 300,
            adaptiveHeight: true
        });
        

        // precision is 10 for 10ths, 100 for 100ths, etc.
        function roundUp(num, precision) {
            return Math.ceil(num * precision) / precision
        }

        let h = document.getElementById('data_kasus');
        let data_rect = h.getBoundingClientRect();
        let prev_left = data_rect.left;

        let breakpoint_1 = data_rect.left - data_rect.width;
        let breakpoint_2 = breakpoint_1 - data_rect.width;

        setInterval(() => {
            let rect = h.getBoundingClientRect();
            let left =  rect.left;

            if (prev_left === left) return;
            let sliding;
            if (prev_left > left) sliding = 'left';
            if (prev_left < left) sliding = 'right';
            let slide;
            
            if (left > breakpoint_1) {
                if (sliding === 'left') {
                    slide = 2; // entering slide 2
                }
                else {
                    slide = 1; // leaving slide 2 into slide 1
                }
                
                let delta = data_rect.left - left;
                let factor = roundUp(delta / data_rect.width, 10);
            }
            
            prev_left = left;
        }); 

        $('.card-call').popover({
            trigger: 'hover'
        })

    });

    function toastMessage() {
        var toast = document.getElementById("snackbar");
        toast.className = "show";
        setTimeout(function(){ toast.className = toast.className.replace("show", ""); }, 3000);
    }

    function counterAnimation() {
        $('.count').each(function () {
            $(this).prop('Counter',0).animate({
                Counter: $(this).text()
            }, {
                duration: 375,
                easing: 'swing',
                step: function (now) {
                    var count = Math.ceil(now).toString();
                    if(Number(count) > 999){
                        while (/(\d+)(\d{3})/.test(count)) {
                            count = count.replace(/(\d+)(\d{3})/, '$1' + '.' + '$2');
                        }
                    }
                    $(this).text(count);
                }
            });
        });
    };

    function check_if_in_view() {
    
        var window_height = $window.height();
        var window_top_position = $window.scrollTop();
        var window_bottom_position = (window_top_position + window_height);

        if(window_top_position > prev) {
            $('.fixed-btm-navbar').addClass('hidden');
            $('.back-to-top').removeClass('hidden');
        } else {
            $('.fixed-btm-navbar').removeClass('hidden');
            $('.back-to-top').addClass('hidden');
        }
        prev = window_top_position;

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

    function provinceFinder(e) {
            if (e.keyCode == 13) {
                var tempArrayData = [];
                var searchResult = "";
                var oldData = "";
                var c = 0;
                var tableHospital = '';
                cardHospital = '';

                axios
                .get('{{ url("data-spread") }}'+`?query=${$('#province_finder').val()}`)
                .then((res) => {
                    
                    var i = {!! json_encode($locations) !!};
                        $.each(i, (k,v) => { 
                        tempArrayData[v.name] = [];
                    });

                    if (res.data.dataFinder == 0) {
                    
                        $( "#input_search" )
                            .animate({ "left": "+=10px" }, 70 )
                            .animate({ "left": "-=15px" }, 70 ).animate({ "left": "+=15px" }, 70 )
                            .animate({ "left": "-=10px" }, 70 );
                        $('.search-not-found').addClass('d-none');
                        $('#alert_search').addClass('alert alert-danger content-sm mt-3 row');
                        $('#icon-alert-search').html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>');
                        $('#alert-search-not-found').html('Provinsi gak ditemukan, coba cari lagi.');

                    } else {

                        $.each(res.data.dataFinder.dataSpread,(k, v) => {

                            if (v.name == "Indonesia") {
                                $('.rs-rujukan').addClass('d-none');
                                $('#alert_search').removeAttr('class');
                                $('#icon-alert-search').html('');
                                $('#alert-search-not-found').html('');
                                $('.search-not-found').removeClass('d-none');
                                $('.slider-for').slick("slickSetOption", "accessibility", false);
                                $('.slider-for').slick("slickSetOption", "draggable", false);
                                $('.slider-for').slick("slickSetOption", "swipe", false);
                                $('.slider-for').slick("slickSetOption", "touchMove", false);
                                $('.slider-for').slick("slickSetOption", "adaptiveHeight", false);
                                $('.slider-for').find(".slick-list").height("auto");
                                // $('.slider-for').slick("slickSetOption", null, null, false);
                                searchResult = v;
                                
                            } else {
                                $('.rs-rujukan').removeClass('d-none');
                                $('#alert_search').removeAttr('class');
                                $('#icon-alert-search').html('');
                                $('#alert-search-not-found').html('');
                                $('.search-not-found').removeClass('d-none');
                                $('.slider-for').slick("slickSetOption", "accessibility", true);
                                $('.slider-for').slick("slickSetOption", "draggable", true);
                                $('.slider-for').slick("slickSetOption", "swipe", true);
                                $('.slider-for').slick("slickSetOption", "touchMove", true);
                                $('.slider-for').find(".slick-list").height("auto");
                                // $('.slider-for').slick("slickSetOption", null, null, false);
                                searchResult = v;
                                
                            }
                        });

                        $.each(res.data.dataFinder.oldDataSpread,(k, v) => {
                            oldData = v
                        });
                        
                        $.each(res.data.dataSpread,(k, v) => {
                            tempArrayData[v.name].push(v);
                        });

                        $.each(tempArrayData["Indonesia"], (k, v) => {
                            totalCase = v;
                        });
                    }

                    $.each($('.provinceSelector'), (k, v) => {
                        if (searchResult.name == "Indonesia") {
                            $('.idn-data').addClass('d-none');
                            $('.data-angka').addClass('d-block');
                            $('.increase-val-data').addClass('top-0');
                        } else {
                            $('.idn-data').addClass('mb-5px');
                            $('.idn-data').removeClass('d-none');
                            $('.data-angka').removeClass('d-block');
                            $('.increase-val-data').removeClass('top-0');
                        }

                        if ($(v).html() == searchResult.name || $(v).data("real") == searchResult.name) {
                            $(v).parent().addClass('card-active'); 
                            last_selected = v;
                            swiper_province.slideTo(k, 500); 
                        } else {
                            $(v).parent().removeClass('card-active');       
                        }
                    });

                    $.each(res.data.dataFinder.hospitalData,(k, v) => {
                        if(v.loc_name == searchResult.name) {
                        
                            c++;

                            tableHospital +=`<tr>
                                        <td>`+ c+`</td>
                                        <td>`+ v.name_hospital +`</td>
                                        <td>`+ v.address +`</td>
                                        <td><a href="`+ v.link_map +`" class="btn btn-outline-purple mt-0" target="_blank">Lihat Peta</a></td>
                                    </tr>`;
                            // hospitalCollection[c] = v;
                            cardHospital +=`<div class="col-md-12 p-0 mb-15">
                                        <div class="card card-data m-0">
                                            <div class="card-body">
                                                <div class ="col-md-12 p-0 my-15 mt-0">
                                                    <h5 class="card-title">`+ v.name_hospital +`</h5>
                                                    <p class="card-text sub-color">`+ v.address +`</p>
                                                </div>
                                                <a href="`+ v.link_map +`" class="btn btn-purple w-100 mt-0" target="_blank">Lihat Peta</a>
                                            </div>
                                        </div>
                                    </div>`;
                        }
                    });

                    for (let index = 0; index < tempArrayData[searchResult.name].length - 1; index++) {
                        var countArray = index + 1;

                        labelDate[index] = moment(tempArrayData[searchResult.name][countArray].updatedAt).format("DD MMM");
                        increasePosiCase[index] = tempArrayData[searchResult.name][countArray].positive - tempArrayData[searchResult.name][index].positive;
                        increaseCuredCase[index] = tempArrayData[searchResult.name][countArray].cured - tempArrayData[searchResult.name][index].cured;
                        increaseDeathCase[index] = tempArrayData[searchResult.name][countArray].death - tempArrayData[searchResult.name][index].death;
                        dataPosiNow = tempArrayData[searchResult.name][countArray].positive - tempArrayData[searchResult.name][index].positive;
                        dataCuredNow = tempArrayData[searchResult.name][countArray].cured - tempArrayData[searchResult.name][index].cured;
                        dataDeathNow = tempArrayData[searchResult.name][countArray].death - tempArrayData[searchResult.name][index].death;
                    }

                    persentaseOfTotalPosi = searchResult.positive/totalCase.positive*100;
                    persentaseOfTotalCured = searchResult.cured/totalCase.cured*100;
                    persentaseOfTotalDeath = searchResult.death/totalCase.death*100;

                    if (dataPosiNow == 0) {
                        dataPosiNow = "-";
                    }
                    if(dataCuredNow == 0) {
                        dataCuredNow = "-";
                    }
                    if(dataDeathNow == 0) {
                        dataDeathNow = "-";
                    }

                    $("#table_hospital").html(tableHospital);
                    $("#card_hospital").html(cardHospital);
                    $("#call_center_name").html(searchResult.call_center_name);
                    $("#hotline_name").html(searchResult.hotline_name);
                    $("#call_center_number").html(searchResult.call_center_number.replace(/\-/g, ' '));
                    $("#hot_line_number").html(searchResult.hotline_number.replace(/\-/g, ' '));

                    $("#txt_confirm").text(searchResult.positive);
                    $("#txt_death").text(searchResult.death);
                    $("#txt_cured").text(searchResult.cured);
                    $("#txt_confirm_idn").html(persentaseOfTotalPosi.toFixed(2).toString().replace(/\./g, ",")+"%");
                    $("#txt_cured_idn").html(persentaseOfTotalCured.toFixed(2).toString().replace(/\./g, ",")+"%");
                    $("#txt_death_idn").html(persentaseOfTotalDeath.toFixed(2).toString().replace(/\./g, ",")+"%");
                    $("#txt_confirm_increase").text(dataPosiNow.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
                    $("#txt_death_increase").text(dataDeathNow.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
                    $("#txt_cured_increase").text(dataCuredNow.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));

                    last_selected = searchResult.name;
                    counterAnimation();
                })
                .catch(err => {
                    console.log(err);
                });
            }
    }



</script>
@endsection
