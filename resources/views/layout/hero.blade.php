@include('layout.head')

<main class="main_content">
    @include('parts.navbar')

    @yield('content')

    @include('parts.btm_navbar')
</main>

@include('layout.footer')
