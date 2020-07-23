        <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/moment@2.18.1/min/moment-with-locales.min.js"></script>
        <script>
                var current = window.location.pathname;
                $('.navbar-nav li a').each(function(){
                    
                    if(this.pathname == current)
                    {
                        $(this).parent().addClass("active");
                    }
                    if (current != "/") {
                        $('.content_header').removeClass("bg-light");
                        $('.content_header').addClass("header-white-bbtm");
                    }
                });

               $('.btm-nav-item a').each(function(){
                    if(this.pathname == current)
                    {   
<<<<<<< HEAD
=======
                        console.log($(this).first());
>>>>>>> ee5a931172e94d57de44016b28a198a28ca2a595
                        $(this).children("div").addClass("btm-nav-active");
                    }else{
                        $(this).children("div").removeClass("btm-nav-active");
                    }
                });
        </script>
        @yield('custom_script')
    </body>
</html>
