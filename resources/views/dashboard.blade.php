<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</head>

<body>
    <div class="container-fluid vh-100 p-0"> <!-- Full viewport height, no padding -->
        <div class="row g-0 h-100"> <!-- No gutter, full height -->
            <!-- Left Side (Black) -->
            <div class="col-md-2 bg-dark text-white p-4"> <!-- Using bg-dark for black -->
                <h2>Dashboard</h2>
                <hr>
                <!-- Your left side content here -->
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Settings</a>
                    </li>
                    <hr>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                                <path fill-rule="evenodd"
                                    d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                            </svg> Logout
                        </button>
                    </form>
                </ul>

            </div>

            <!-- Right Side (White) -->
            <div class="col-md-7 bg-white p-4">
                <h2>Welcome back, {{ Auth::user()->name }}!</h2>
                <!-- Your right side content here -->
                <div class="row">
                    <div class="card col-sm-4 mx-5">
                        <div class="card-body">
                            <button class="btn bg-success text-light">Check IP address</button>
                        </div>
                    </div>
                    <div class="card col-sm-4 mx-5">
                        <div class="card-body">
                            <button class="btn bg-success text-light">Check IP address</button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <footer class="py-2 bg-light">
            <div class="text-center">
                <span>&copy; Copyright, 2025 by <a href="https://github.com/fistonsano04" target="_blank"
                        class="text-danger">Iamsano</a></span>
            </div>
        </footer>
    </div>
</body>

</html>
