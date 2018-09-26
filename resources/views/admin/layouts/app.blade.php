<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Капитал</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @yield('styles')

</head>
<body>
@if(Auth::check())
    @include('admin.includes.sidebar')

    <div id="main" style="margin-left: 250px">

        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{{ \Session::get('success') }}</li>
                </ul>
            </div>
        @elseif(\Session::has('error'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{ \Session::get('error') }}</li>
                </ul>
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')

        <flash message="{{ session('message') }}" classname="{{ session('class') }}"></flash>

    </div>
@else
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>
@endif



<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

@yield('scripts')
<script>
    /* Set the width of the side navigation to 250px */
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    /* Set the width of the side navigation to 0 */
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }

    /* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
    }

    /* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
    }

</script>

</body>
</html>
