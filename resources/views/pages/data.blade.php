@extends('layout.hero')

@section('content')
<section class="section-data-top">
    <div class="row content">
        <div class="col-md-12 content-sm-ml p-0 text-left">
            <h4 style="font-weight: bold">
                Data Kasus Covid-19
            </h4>
            <label class="sub-color" style="font-weight: 400;">
                Pembaharuan Terakhir:<br> <span id="updated_at"></span>
            </label>
        </div>
        <div id="input_search" class="col-lg-12 col-md-12 p-0 mt-20 input-bg border-radius-10 content-sm">
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

                    @foreach ($data as $key)
                        <div class="swiper-slide swiper-slide-active" style="width: auto; margin-right: 25px;">
                            <div class="card card-location" style="cursor:pointer">
                                <div class="card-province text-center provinceSelector">{{ $data[$val]->name }}</div>
                            </div>
                        </div>
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
        <div class="col-md-12 p-0">
            <div class="row search-not-found">
                <div id="data_kasus" class="col-md-12 content-sm mt-20 search-not-found">
                    <div class="row">
                        <div class="col-md-4 p-0 ">
                            <div class="card card-data card-data-left">
                                <div class="card-body-data wrap">
                                    <div class=" whitespace-data-left mt-0">
                                        <span class="d-block main-title-md">TERKONFIRMASI</span>
                                        <span id="txt_confirm" class="color-orange data-angka count">-</span>
                                        <div class="increase-val-1 increase-val-data increase-val">
                                            <i class="fas fa-arrow-up"></i>
                                            <span id="txt_confirm_increase" class="txt_increase">0</span>
                                        </div>
                                        <span class="d-block main-title-md" >Indonesia</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 p-0">
                            <div class="card card-data card-data-middle">
                                <div class="card-body-data wrap">

                                    <div class=" whitespace-data-left mt-0">
                                        <span class="d-block main-title-md" >SEMBUH</span>
                                        <span id="txt_cured" class="color-green data-angka count">-</span>
                                        <div class="increase-val-3 increase-val-data increase-val">
                                            <i class="fas fa-arrow-up"></i>
                                            <span id="txt_cured_increase" class="txt_increase">0</span>
                                        </div>
                                        <span class="d-block main-title-md" >Indonesia</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 p-0">
                            <div class="card card-data card-data-right">
                                <div class="card-body-data wrap">
                                    <div class=" whitespace-data-left mt-0">
                                        <span class="d-block main-title-md" >MENINGGAL</span>
                                        <span id="txt_death" class="color-purple data-angka count">-</span>
                                        <div class="increase-val-2 increase-val-data increase-val">
                                            <i class="fas fa-arrow-up"></i>
                                            <span id="txt_death_increase" class="txt_increase">0</span>
                                        </div>
                                        <span class="d-block main-title-md" >Indonesia</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 p-0">
                            <div class="card card-data animation-element slide-bottom-dly-145s">
                                <div class="">
                                    <div class="card-body pb-2">
                                        <label class="d-block main-title-md" style="word-break: normal">Chart Peningkatan Kasus Covid-19 <span id="loc_name"></span></label>
                                    </div>
                                    
                                    <hr>
                                    <div class="card-body chart-container">
                                        <canvas id="chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('custom_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>

    var scene = document.getElementById('scene');
    // var parallaxInstance = new Parallax(scene);

    var $animation_elements = $('.animation-element');
    var $window = $(window);
    var prev = 0;
    var provinceSelect = "";

    $(document).ready(function() {
        // getNewsData();
        $window.on('scroll resize', check_if_in_view);

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

        $.each($('.provinceSelector'), (k, v) => {
            vHtml = $(v).html();
            
            if(vHtml == "Aceh"){
                $(v).parent().addClass('card-active');
                $('.rs-rujukan').addClass('d-none');
                $('#rs_rujukan').addClass('d-none');
                $('.slider-for').slick("slickSetOption", "accessibility", false);
                $('.slider-for').slick("slickSetOption", "draggable", false);
                $('.slider-for').slick("slickSetOption", "swipe", false);
                $('.slider-for').slick("slickSetOption", "touchMove", false);
                provinceSelect = "Aceh"
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

        getData(provinceSelect);

        $('.provinceSelector').click((e) => {
            
            var arrayKey = $(e.target).data("real");
            
            // var finalResultData = dataCorona[arrayKey];
            // var finalResultOldData = oldCaseData[arrayKey];
            
            $('.card-location').removeClass('card-active');
            $(e.target.parentElement).addClass('card-active');
            
            if(arrayKey == 'Aceh'){
                $('.rs-rujukan').addClass('d-none');
                $('#rs_rujukan').addClass('d-none');
            }else{
                $('.rs-rujukan').removeClass('d-none');
                $('#rs_rujukan').removeClass('d-none');
            };

            provinceSelect = arrayKey;

            getData(provinceSelect);
            // removeData(chart);

        });
        

    });

    function getData(province){
        axios.get('{{ url("data") }}/' + province).then((res) => {
            moment.locale("id");
            var labelDate = [];
            var valueDataPosi = [];
            var valueDataCured = [];
            var valueDataDeath = [];
            var oldValueDataPosi = [];
            var oldValueDataCured = [];
            var oldValueDataDeath = [];
            var valueDataDeathFinal = 0;
            var valueDataPosiFinal = 0;
            var valueDataCuredFinal = 0;
            var increasePosiCase = [];
            var increaseCuredCase = [];
            var increaseDeathCase = [];
            var countArrayData = 1;
            var countArrayOldData = 0;
            var locName = "";
            var ctx = document.getElementById('chart').getContext('2d'),
                gradientPosi = ctx.createLinearGradient(0, 0, 0, 350),
                gradientCured = ctx.createLinearGradient(0, 0, 0, 350),
                gradientDeath = ctx.createLinearGradient(0, 0, 0, 350);

            gradientPosi.addColorStop(0, 'rgba(249,135,135, 0.5)');
            gradientPosi.addColorStop(0.5, 'rgba(249,135,135, 0.1)');
            gradientPosi.addColorStop(1, 'rgba(249,135,135, 0)');
            gradientCured.addColorStop(0, 'rgba(134,189,44, 0.5)');
            gradientCured.addColorStop(0.5, 'rgba(134,189,44, 0.1)');
            gradientCured.addColorStop(1, 'rgba(134,189,44, 0)');
            gradientDeath.addColorStop(0, 'rgba(202,76,129, 0.5)');
            gradientDeath.addColorStop(0.5, 'rgba(202,76,129, 0.1)');
            gradientDeath.addColorStop(1, 'rgba(202,76,129, 0)');

            // chart.destroy();

            $.each(res.data.dataSpread, (k,v) => {
                locName = v.name
                valueDataPosi[k] = v.positive;
                valueDataCured[k] = v.cured;
                valueDataDeath[k] = v.death;
                valueDataPosiFinal = v.positive;
                valueDataCuredFinal = v.cured;
                valueDataDeathFinal = v.death;
            });

            $.each(res.data.oldDataSpread, (k,v) => {
                labelDate[k] = moment(v.updated_at).format("DD MMM");
                oldValueDataPosi[k] = v.positive;
                oldValueDataCured[k] = v.cured;
                oldValueDataDeath[k] = v.death;
                
                increasePosiCase[k] = valueDataPosi[countArrayData]-oldValueDataPosi[countArrayOldData];
                increaseCuredCase[k] = valueDataCured[countArrayData]-oldValueDataCured[countArrayOldData];
                increaseDeathCase[k] = valueDataDeath[countArrayData]-oldValueDataDeath[countArrayOldData];
                countArrayData ++;
                countArrayOldData ++;

            });
            
            
            var data = {
                labels: labelDate,
                datasets: [{
                    label: "Meninggal",
                    backgroundColor:  gradientDeath,
                    borderColor: "rgba(202,76,129,1)",
                    borderWidth: 2,
                    hoverBackgroundColor: "rgba(202,76,129,0.4)",
                    hoverBorderColor: "rgba(202,76,129,1)",
                    stack: 'Stack 0',
                    data: increaseDeathCase,
                },{
                    label: "Sembuh",
                    backgroundColor: gradientCured,
                    borderColor: "rgba(134,189,44,1)",
                    borderWidth: 2,
                    hoverBackgroundColor: "rgba(134,189,44,0.4)",
                    hoverBorderColor: "rgba(134,189,44,1)",
                    stack: 'Stack 0',
                    data: increaseCuredCase,
                },
                {
                    label: "Terkonfirmasi",
                    backgroundColor: gradientPosi,
                    borderColor: "rgba(249,135,135,1)",
                    borderWidth: 2,
                    hoverBackgroundColor: "rgba(249,135,135,0.4)",
                    hoverBorderColor: "rgba(249,135,135,1)",
                    stack: 'Stack 0',
                    data: increasePosiCase,
                }]
            };

            var options = {
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                responsive: true,
                scales: {
                    yAxes: [{
                    stacked: true,
                    gridLines: {
                        display: true,
                        color: "rgba(115, 80, 162, 0.1)"
                    }
                    }],
                    xAxes: [{
                        stacked: true,
                        gridLines: {
                            display: false
                        }
                    }]
                }
            };

            var chart = new Chart(ctx, {
                type: 'line',
                options: options,
                data: data
            });

            $("#loc_name").html(locName);
            $("#txt_confirm").text(valueDataPosiFinal);
            $("#txt_cured").text(valueDataCuredFinal);
            $("#txt_death").text(valueDataDeathFinal);

            counterAnimation();
        });
    }

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
</script>
@endsection