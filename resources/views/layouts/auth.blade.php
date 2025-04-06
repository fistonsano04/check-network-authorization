<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Authentication Page </title>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/auth.css') }}">
    <!-- JS -->
    <script src="{{ url('assets/js/auth.js') }}"></script>
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <section class="container forms">
        @yield('content')

    </section>
</body>

</html>
