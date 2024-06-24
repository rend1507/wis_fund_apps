@include('includes/head')

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        @include('includes/header')
        @include('includes/sidebar')

        <!--begin::App Main-->
        <main class="app-main">
            @yield('content')
            @include('includes/foot')
        </main>
    </div>
    @include('includes/script')
</body>

</html>