<header class="content_header bg-light">
    <div class="content content-sm">
        <div class="navbar navbar-expand-lg navbar-light nav-padding">
            <a class="navbar-brand" href="#"><img src="{{ asset('assets/img/logo_secunder.svg') }}" width="auto" height="50" alt=""></a>

            <div class="collapse navbar-collapse show-content-lg d-sm-none" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route("home") }}">Home</a>
                        {{-- <div style="width:100%; height:4px; background: linear-gradient(266.91deg, rgba(126, 93, 169, 0.75) 7.66%, rgba(117, 79, 166, 0.75) 99.73%); border-radius: 4.28125px;">
                        </div> --}}
                    </li>
                    <li class="nav-item ml-3">
                        <a class="nav-link" href="{{ route("dataPage") }}">Data</a>
                    </li>
                    <li class="nav-item ml-3">
                        <a class="nav-link" href="{{ route("newsPage") }}">Berita</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
