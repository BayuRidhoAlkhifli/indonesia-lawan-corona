@include('layout.head')

<main class="main_content">
    @include('parts.navbar')

    @yield('content')
</main>

@include('layout.footer')
