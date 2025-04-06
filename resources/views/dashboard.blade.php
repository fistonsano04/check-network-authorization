@extends('layouts.navigation')
@section('content')
    <div class="container-fluid vh-100 p-0"> <!-- Full viewport height, no padding -->
        <div class="row g-0 h-100"> <!-- No gutter, full height -->
            <!-- Left Side (Black) -->
            <div class="col-md-2 bg-dark text-white p-4"> <!-- Using bg-dark for black -->
                <h2>Dashboard</h2>
                <hr>
                <!-- Your left side content here -->
                <ul class="nav flex-column">
                    <h6>Hello, <span class="text-warning">{{ Auth::user()->name }}</span></h6>

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
                <h4 class="text-primary mb-5 text-uppercase">Check Network details</h4>
                <hr>
                <!-- Your right side content here -->
                <div class="row mt-5">
                    <button class="btn card col-sm-4 mx-5 bg-success border-0 text-light" onclick="showNetworkInfo()">
                        <div class="card-body">
                            Check IP address
                        </div>
                    </button>
                    <button class="btn card col-sm-4 mx-5 bg-warning border-0 text-light" onclick="disconnectNetwork()">
                        <div class="card-body">
                            Disconnect Network
                        </div>
                    </button>

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

   
@endsection
