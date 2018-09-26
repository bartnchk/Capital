<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subscribers test</title>
</head>
<body>

    @if( Session::has('error') )
        <div class="alert alert-danger">
            <ul>
                <li>{{ Session::get('error') }}</li>
            </ul>
        </div>
    @endif

    @if( Session::has('message') )
        <div class="alert alert-danger">
            <ul>
                <li>{{ Session::get('message') }}</li>
            </ul>
        </div>
    @endif

    <form action="{{ route('subscribe') }}" method="get">

        <input type="email" name="email" required>
        <input type="submit">

    </form>

</body>

<script src="{{ asset('js/site.js') }}"></script>

</html>