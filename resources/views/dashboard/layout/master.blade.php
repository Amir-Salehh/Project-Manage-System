@include('dashboard.layout.loggedIn')

<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    @if($title == "پنل مدیریت پروژه")
    <link rel="stylesheet" href="{{ asset('css/dashboard/index.css') }}">
    @elseif($title == "ساخت پروژه جدید")
    <link rel="stylesheet" href="{{ asset('css/dashboard/create.css') }}">
    @else
    <link rel="stylesheet" href="{{ asset('css/dashboard/edit.css') }}">
    @endif
    <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@latest/dist/css/persian-datepicker.css"/>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://unpkg.com/persian-date@latest/dist/persian-date.js"></script>
    <script src="https://unpkg.com/persian-datepicker@latest/dist/js/persian-datepicker.js"></script>
</head>
<body>

    @include('dashboard.layout.header')

    @yield('content')

    @include('dashboard.layout.footer')

</body>
</html>
