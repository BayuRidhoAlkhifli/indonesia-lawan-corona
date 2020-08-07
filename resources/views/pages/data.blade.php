@extends('layout.hero')

@section('content')
<section class="section-data-top">
    <div class="row content">
        <div class="col-md-12 content-sm p-0 text-left mb-15">
            <h4 style="font-weight: bold">
                Data Kasus Covid-19
            </h4>
            <label class="sub-color sub-title" style="font-weight: 400;">
                Pembaharuan Terakhir: <span id="updated_at"></span>
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
            <div class="province-suggest">
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
        <div class="col-md-12 p-0">
            <div class="row search-not-found">
                <div id="data_kasus" class="col-md-12 content-sm mt-20 search-not-found">
                    <div class="row">
                        <div class="col-md-4 p-0 ">
                            <div class="card card-data card-data-left">
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
                            <div class="card card-data card-data-middle">
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
                            <div class="card card-data card-data-right">
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
                    </div>
                    <div class="row">
                        <div class="col-md-12 p-0">
                            <div class="card card-data animation-element slide-bottom-dly-145s mb-30">
                                <div>
                                    <div class="card-body row pb-2 p-20">
                                        <div class="col-md-6 p-0">
                                            <label class="d-block main-title-md" style="word-break: normal">Data Peningkatan Kasus Covid-19 <span id="loc_name"></span></label>
                                        </div>
                                        <div class="col-md-6 p-0 row m-0">
                                            <div class="d-flex">
                                                <div class="color-case bg-orange"></div><label class="ml-10 mb-0" style="padding-top: 1px">Terkonfirmasi</label>
                                            </div>
                                            <div class="d-flex ml-15">
                                                <div class="color-case bg-green"></div><label class="ml-10 mb-0" style="padding-top: 1px">Sembuh</label>
                                            </div>
                                            <div class="last-col-sta">
                                                <div class="color-case bg-purple"></div><label class="ml-10 mb-0" style="padding-top: 1px">Meninggal</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    <div class="card-body chart-container">
                                        <canvas id="chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 p-0">
                            <div class="card card-data card-data-left">
                                <div class="card-body pb-2">
                                    <label class="d-block main-title-md" style="word-break: normal">Data Terkonfirmasi</label>
                                </div>
                                <hr>
                                <div class="card-body chart-dought-container p-0">
                                    <canvas id="chartDough" class="mx-auto" width="210" height="210"></canvas>
                                </div>
                                <hr>
                                <div class="card-body pt-2">
                                    <label class="d-block main-title-md" style="word-break: normal"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 p-0">
                            <div class="card card-data card-data-middle">
                                <div class="card-body pb-2">
                                    <label class="d-block main-title-md" style="word-break: normal">Data Sembuh</label>
                                </div>
                                <hr>
                                <div class="card-body chart-dought-container p-0">
                                    <canvas id="chartDough" class="mx-auto" width="210" height="210"></canvas>
                                </div>
                                <hr>
                                <div class="card-body pt-2">
                                    <label class="d-block main-title-md" style="word-break: normal"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 p-0">
                            <div class="card card-data card-data-right">
                                <div class="card-body pb-2">
                                    <label class="d-block main-title-md" style="word-break: normal">Data Meninggal</label>
                                </div>
                                <hr>
                                <div class="card-body chart-dought-container p-0">
                                    <canvas id="chartDough" class="mx-auto" width="210" height="210"></canvas>
                                </div>
                                <hr>
                                <div class="card-body pt-2">
                                    <label class="d-block main-title-md" style="word-break: normal"></label>
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

    var increasePosiCase = [];
    var increaseCuredCase = [];
    var increaseDeathCase = [];
    var labelDate = [];
    var labelLoc = [];
    var proviPercentagePosi = [];

    var placeHolder = ['Cari provinsi', 'Misal Papua, Jawa Timur, dll'];
    var arrayPlaceHolder = 0;
    var loopLength = placeHolder.length;

    var dataSelected = "";
    var oldDataSelected = "";
    var last_selected = "";
    

    var dataPosiNow = 0;
    var dataCuredNow = 0;
    var dataDeathNow = 0;

    var chart = {};
    var cd = document.getElementById('chartDough');
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

    $(document).ready(function() {
        // getNewsData();
        $window.on('scroll resize', check_if_in_view);

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

        $window.scroll(function(){
            // if ($(window).scrollTop() >= 745) {
            //     $('.content_header').addClass('fixed-header');
            //     $('.content_header').removeClass('header-white-bbtm');
                
            //     // $('nav div').addClass('visible-title');
            // }
            // else {
            //     $('.content_header').removeClass('fixed-header');
            //     $('.content_header').addClass('header-white-bbtm');
                
            //     // $('nav div').removeClass('visible-title');
            // }

            // if ($(window).scrollTop() >= 1400) {
            //     $('.back-to-top').fadeIn();
            //     // $('nav div').addClass('visible-title');
            // }
            // else {
            //     $('.back-to-top').fadeOut();
            // }
        });

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

        getData();

        $('.provinceSelector').click((e) => {
            
            var arrayKey = $(e.target).data("real");
            
            var finalResultStatistic = dataStatistic[arrayKey];
            var finalResultOldStatistic = oldDataStatistic[arrayKey];
            
            $('.card-location').removeClass('card-active');
            $(e.target.parentElement).addClass('card-active');

            // removeData(chart);
            $.each(finalResultStatistic, (k, v) => {
                dataSelected = v;
            });

            $.each(finalResultOldStatistic, (k, v) => {
                oldDataSelected = v;
            });

            $.each(dataStatistic["Indonesia"], (k, v) => {
                indonesiaData = v;
            });

            if(arrayKey == 'Indonesia'){
                $('.idn-data').addClass('d-none');
                $('.data-angka').addClass('d-block');
                $('.increase-val-data').addClass('top-0');
            }else{
                $('.idn-data').addClass('mb-5px');
                $('.idn-data').removeClass('d-none');
                $('.data-angka').removeClass('d-block');
                $('.increase-val-data').removeClass('top-0');
            };

            for (let index = 0; index < finalResultStatistic.length - 1; index++) {
                var countArray = index + 1;

                labelDate[index] = moment(finalResultStatistic[countArray].updated_at).format("DD MMM");
                increasePosiCase[index] = finalResultStatistic[countArray].positive - finalResultOldStatistic[index].positive;
                increaseCuredCase[index] = finalResultStatistic[countArray].cured - finalResultOldStatistic[index].cured;
                increaseDeathCase[index] = finalResultStatistic[countArray].death - finalResultOldStatistic[index].death;
            }

            dataPosiNow = dataSelected.positive - oldDataSelected.positive;
            dataCuredNow = dataSelected.cured - oldDataSelected.cured;
            dataDeathNow = dataSelected.death - oldDataSelected.death;

            persentaseOfTotalPosi = dataSelected.positive/indonesiaData.positive*100;
            persentaseOfTotalCured = dataSelected.cured/indonesiaData.cured*100;
            persentaseOfTotalDeath = dataSelected.death/indonesiaData.death*100;

            if (dataPosiNow == 0) {
                dataPosiNow = "-";
            }
            if(dataCuredNow == 0) {
                dataCuredNow = "-";
            }
            if(dataDeathNow == 0) {
                dataDeathNow = "-";
            }

            $("#loc_name").html(dataSelected.name);
            $("#txt_confirm").text(dataSelected.positive);
            $("#txt_cured").text(dataSelected.cured);
            $("#txt_death").text(dataSelected.death);
            $("#txt_confirm_idn").html(persentaseOfTotalPosi.toFixed(2).toString().replace(/\./g, ",")+"%");
            $("#txt_cured_idn").html(persentaseOfTotalCured.toFixed(2).toString().replace(/\./g, ",")+"%");
            $("#txt_death_idn").html(persentaseOfTotalDeath.toFixed(2).toString().replace(/\./g, ",")+"%");
            $("#txt_confirm_increase").text(dataPosiNow.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
            $("#txt_death_increase").text(dataDeathNow.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
            $("#txt_cured_increase").text(dataCuredNow.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));

            if (chart) {
                chart.destroy();
            }

            displayChart(labelDate,increaseDeathCase,increaseCuredCase,increasePosiCase,gradientDeath,gradientCured,gradientPosi);
            
            counterAnimation();
        });

        $('#province_finder').on('input', function() {
            if ($('#province_finder').val() == ''){
                $('#alert_search').removeAttr('class');
                $('#icon-alert-search').html('');
                $('#alert-search-not-found').html('');
                $('.search-not-found').removeClass('d-none');
            }

            // $(last_selected).parent().addClass('card-active'); 
            
        });

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
            
            suggestionFinder();
        });
        
    });

    function getData() {
        axios.get('{{ route("get.dataStatistic") }}').then((res) => {
            moment.locale("id");
            
            var tempArrayStatistic = [];
            var tempOldArrayStatistic = [];

            var i = {!! json_encode($locations) !!};
            
            $.each(i, (k,v) => { 
                tempArrayStatistic[v.name] = [];
                tempOldArrayStatistic[v.name] = [];
            });

            $.each(res.data.dataSpread, (k,v) => { 
                tempArrayStatistic[v.name].push(v);
            });

            $.each(res.data.oldDataSpread, (k,v) => {
                tempOldArrayStatistic[v.loc_name].push(v);
            });

            $.each(res.data.dataPercentage, (k,v) => {
                proviPercentagePosi[k] = v.positive;
                labelLoc[k] = v.loc_name;
            });

            dataStatistic  = (tempArrayStatistic);
            oldDataStatistic = (tempOldArrayStatistic);

            $.each(dataStatistic["Indonesia"], (k, v) => {
                dataSelected = v;
            });

            $.each(oldDataStatistic["Indonesia"], (k, v) => {
                oldDataSelected = v;
            });

            for (let index = 0; index < dataStatistic["Indonesia"].length - 1; index++) {
                var countArray = index + 1;

                labelDate[index] = moment(dataStatistic["Indonesia"][countArray].updated_at).format("DD MMM");
                increasePosiCase[index] = dataStatistic["Indonesia"][countArray].positive - oldDataStatistic["Indonesia"][index].positive;
                increaseCuredCase[index] = dataStatistic["Indonesia"][countArray].cured - oldDataStatistic["Indonesia"][index].cured;
                increaseDeathCase[index] = dataStatistic["Indonesia"][countArray].death - oldDataStatistic["Indonesia"][index].death;
            }

            $.each($('.provinceSelector'), (k, v) => {
                vHtml = $(v).html();
                
                if(vHtml == "Indonesia"){
                    $(v).parent().addClass('card-active');
                    $('.idn-data').addClass('d-none');
                    $('.data-angka').addClass('d-block');
                    $('.increase-val-data').addClass('top-0');
                    provinceSelect = "Indonesia"
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

            dataPosiNow = dataSelected.positive - oldDataSelected.positive;
            dataCuredNow = dataSelected.cured - oldDataSelected.cured;
            dataDeathNow = dataSelected.death - oldDataSelected.death;

            if (dataPosiNow == 0) {
                dataPosiNow = "-";
            }
            if(dataCuredNow == 0) {
                dataCuredNow = "-";
            }
            if(dataDeathNow == 0) {
                dataDeathNow = "-";
            }
            
            $("#loc_name").html(dataSelected.name);
            $("#updated_at").html(moment(dataSelected.updated_at).format("dddd,  DD MMMM YYYY HH:mm"));
            $("#txt_confirm").html(dataSelected.positive);
            $("#txt_death").html(dataSelected.death);
            $("#txt_cured").html(dataSelected.cured);
            $("#txt_confirm_increase").html(dataPosiNow.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
            $("#txt_death_increase").html(dataDeathNow.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
            $("#txt_cured_increase").html(dataCuredNow.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));

            displayChart(labelDate,increaseDeathCase,increaseCuredCase,increasePosiCase,gradientDeath,gradientCured,gradientPosi);

            displayChartDough(labelLoc, proviPercentagePosi);
            counterAnimation();
        });
        
    };

    function provinceFinder(e) {
            if (e.keyCode == 13){

                axios
                .get('{{ url("data-statistic") }}'+`?query=${$('#province_finder').val()}`)
                .then(res => {
                    moment.locale("id");
                    var tempArrayStatistic = [];
                    var searchResult = [];
                    var oldData = "";

                    var i = {!! json_encode($locations) !!};
                        $.each(i, (k,v) => { 
                        tempArrayStatistic[v.name] = [];
                    });

                    if (res.data.statistic == 0) {
                        $( "#input_search" )
                            .animate({ "left": "+=10px" }, 70 )
                            .animate({ "left": "-=15px" }, 70 ).animate({ "left": "+=15px" }, 70 )
                            .animate({ "left": "-=10px" }, 70 );
                        $('.search-not-found').addClass('d-none');
                        $('#alert_search').addClass('alert alert-danger content-sm mt-3 row');
                        $('#icon-alert-search').html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>');
                        $('#alert-search-not-found').html('Provinsi gak ditemukan, coba cari lagi.');
                    } else {
                        $.each(res.data.statistic.dataSpread,(k, v) => {

                                $('#alert_search').removeAttr('class');
                                $('#icon-alert-search').html('');
                                $('#alert-search-not-found').html('');
                                $('.search-not-found').removeClass('d-none');
                                searchResult = v;
                        });

                        $.each(res.data.statistic.oldDataSpread,(k, v) => {
                            oldData = v
                        });
                        
                        $.each(res.data.dataSpread,(k, v) => {
                            tempArrayStatistic[v.name].push(v);
                        });

                        $.each(tempArrayStatistic["Indonesia"], (k, v) => {
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

                    for (let index = 0; index < tempArrayStatistic[searchResult.name].length - 1; index++) {
                        var countArray = index + 1;

                        labelDate[index] = moment(tempArrayStatistic[searchResult.name][countArray].updatedAt).format("DD MMM");
                        increasePosiCase[index] = tempArrayStatistic[searchResult.name][countArray].positive - tempArrayStatistic[searchResult.name][index].positive;
                        increaseCuredCase[index] = tempArrayStatistic[searchResult.name][countArray].cured - tempArrayStatistic[searchResult.name][index].cured;
                        increaseDeathCase[index] = tempArrayStatistic[searchResult.name][countArray].death - tempArrayStatistic[searchResult.name][index].death;
                        dataPosiNow = tempArrayStatistic[searchResult.name][countArray].positive - tempArrayStatistic[searchResult.name][index].positive;
                        dataCuredNow = tempArrayStatistic[searchResult.name][countArray].cured - tempArrayStatistic[searchResult.name][index].cured;
                        dataDeathNow = tempArrayStatistic[searchResult.name][countArray].death - tempArrayStatistic[searchResult.name][index].death;
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

                    $("#loc_name").html(searchResult.name);
                    $("#txt_confirm").text(searchResult.positive);
                    $("#txt_death").text(searchResult.death);
                    $("#txt_cured").text(searchResult.cured);
                    $("#txt_confirm_idn").html(persentaseOfTotalPosi.toFixed(2).toString().replace(/\./g, ",")+"%");
                    $("#txt_cured_idn").html(persentaseOfTotalCured.toFixed(2).toString().replace(/\./g, ",")+"%");
                    $("#txt_death_idn").html(persentaseOfTotalDeath.toFixed(2).toString().replace(/\./g, ",")+"%");
                    $("#txt_confirm_increase").text(dataPosiNow.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
                    $("#txt_death_increase").text(dataDeathNow.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
                    $("#txt_cured_increase").text(dataCuredNow.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));

                    if (chart) {
                        chart.destroy();
                    }

                    displayChart(labelDate,increaseDeathCase,increaseCuredCase,increasePosiCase,gradientDeath,gradientCured,gradientPosi);
                    counterAnimation();
                })
                .catch(err => {
                    console.log(err);
                });

            }
    };

    function displayChart(label, deathCase, curedCase, posiCase, deathBg, curedBg, posiBg) {

        var data = {
            labels: label,
            datasets: [{
                label: "Meninggal",
                backgroundColor:  deathBg,
                borderColor: "rgba(202,76,129,1)",
                borderWidth: 2,
                hoverBackgroundColor: "rgba(202,76,129,0.4)",
                hoverBorderColor: "rgba(202,76,129,1)",
                stack: 'Stack 0',
                data: deathCase,
            },{
                label: "Sembuh",
                backgroundColor: curedBg,
                borderColor: "rgba(134,189,44,1)",
                borderWidth: 2,
                hoverBackgroundColor: "rgba(134,189,44,0.4)",
                hoverBorderColor: "rgba(134,189,44,1)",
                stack: 'Stack 0',
                data: curedCase,
            },
            {
                label: "Terkonfirmasi",
                backgroundColor: posiBg,
                borderColor: "rgba(249,135,135,1)",
                borderWidth: 2,
                hoverBackgroundColor: "rgba(249,135,135,0.4)",
                hoverBorderColor: "rgba(249,135,135,1)",
                stack: 'Stack 0',
                data: posiCase,
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

        chart = new Chart(ctx, {
            type: 'line',
            options: options,
            data: data
        });

    };

    function displayChartDough(label, positive) {

        var data = {
            labels: label,
            datasets: [{
            label: '# of Tomatoes',
            data: positive,
            backgroundColor: [
                '#221f3b',
                '#6f4a8e',
                '#f09ae9',
                '#ffc1fa',
                '#ffe78f',
                '#ffd36b',
                '#cdb30c',
                '#62760c',
                '#535204',
                '#523906',
                '#595238',
                '#f08a5d',
                '#0f4c75',
                '#3282b8',
                '#bbe1fa',
                '#7fdbda',
                '#4ea0ae',
                '#24a19c',
                '#6ebfb5',
                '#99b898',
                '#6f4a8e',
                '#6f4a8e',
                '#6f4a8e',
                '#6f4a8e',
                '#6f4a8e',
                '#6f4a8e',
                '#6f4a8e',
                '#6f4a8e',
                '#6f4a8e',
                '#6f4a8e',
                '#6f4a8e',
                '#6f4a8e',
                '#6f4a8e',
                '#6f4a8e'
            ],
            borderWidth: 1
            }]
        };

        var options = {
            //cutoutPercentage: 40,
            legend: {
                display: false
            },
            responsive: false,
        };

        var chartDough = new Chart(cd, {
            type: 'doughnut',
            options: options,
            data: data
        });

    };

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

    };

    function suggestionFinder() {

        axios
        .get('{{ url("data-statistic") }}'+`?query=${$('#province_finder').val()}`)
        .then((res) => {
            
            const countries = res.data.statistic.provinceLoc;

                const searchInput = document.querySelector('.search-input');
                const suggestionsPanel = document.querySelector('.province-suggest');

                searchInput.addEventListener('keyup', () => {
                    const input = searchInput.value;
                    suggestionsPanel.innerHTML = '';
                    const suggestions = countries.filter((country) => {
                        return country.name.toLowerCase().startsWith(input);
                    });
                    suggestions.forEach((suggested) => {
                        const div = document.createElement('div');
                        div.innerHTML = "<strong>" + suggested.name.substr(0, input.length) + "</strong>";
                        div.innerHTML += suggested.name.substr(input.length);
                        div.setAttribute("class", "suggest-finder");
                        div.setAttribute('onclick', `suggestionClick('${suggested.name}')`);
                        document.querySelector("#input_search").style.boxShadow = "0 13px 15px -12px rgba(65, 41, 88, 0.301)"
                        suggestionsPanel.appendChild(div);
                    });
                    if (input === '') {
                        suggestionsPanel.innerHTML = '';  
                    }
                })
        })
        .catch(err => {
            console.log(err);
        });
            
    }

    const suggestionClick = (param) => {
        var tempArrayData = [];
        var searchResult = "";
        var oldData = "";
        var c = 0;
        var tableHospital = '';
        cardHospital = '';

        axios
        .get('{{ url("data-statistic") }}'+`?query=`+ param)
        .then((res) => {

            var i = {!! json_encode($locations) !!};
                    $.each(i, (k,v) => { 
                    tempArrayData[v.name] = [];
                });

            $.each(res.data.statistic.dataSpread,(k, v) => {
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

            $.each(res.data.statistic.oldDataSpread,(k, v) => {
                oldData = v
            });
            
            $.each(res.data.dataSpread,(k, v) => {
                tempArrayData[v.name].push(v);
            });

            $.each(tempArrayData["Indonesia"], (k, v) => {
                totalCase = v;
            });

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

            $("#province_finder").val(param);
            $(".province-suggest").empty();
        })
        .catch(err => {
            console.log(err);
        });
    }

</script>
@endsection