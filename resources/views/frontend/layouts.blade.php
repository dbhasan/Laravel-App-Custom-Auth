@include('frontend.header')

<body>

    <!-- ======= Header ======= -->
    <header>
        <h1>This is Header</h1>
    </header>


    {{-- ------------content part-------------- --}}
    @yield('content')
    {{-- ------------content part-------------- --}}

    <!-- ======= Footer ======= -->
    <footer>
        <h1>This is Footer</h1>
    </footer>

    @include('frontend.footer');
</body>

</html>
