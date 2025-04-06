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
                    <button class="btn card col-sm-4 mx-5 bg-warning border-0 text-light">
                        <div class="card-body">
                            Check IP address
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Function to get comprehensive network information
            async function getNetworkInfo() {
                try {
                    // Get IP address
                    const ipResponse = await fetch('https://api.ipify.org?format=json');
                    const ipData = await ipResponse.json();

                    // Get location and other details (using ip-api.com)
                    const detailsResponse = await fetch(
                        `http://ip-api.com/json/${ipData.ip}?fields=status,message,continent,country,regionName,city,isp,org,as,mobile,proxy,hosting,query`
                        );
                    const detailsData = await detailsResponse.json();

                    // Get bandwidth information (simulated)
                    const bandwidth = await simulateBandwidthTest();

                    // Get connection type
                    const connectionType = navigator.connection ? navigator.connection.effectiveType :
                    'Unknown';

                    // Get network status
                    const networkStatus = navigator.onLine ? 'Online' : 'Offline';

                    return {
                        ip: ipData.ip,
                        location: detailsData,
                        bandwidth,
                        connectionType,
                        networkStatus,
                        timestamp: new Date().toLocaleString()
                    };
                } catch (error) {
                    console.error("Error fetching network info:", error);
                    return null;
                }
            }

            // Simulate bandwidth test
            async function simulateBandwidthTest() {
                const startTime = performance.now();
                // Test download speed with a small image
                await fetch('https://source.unsplash.com/random/100x100');
                const endTime = performance.now();
                const duration = (endTime - startTime) / 1000; // in seconds
                const sizeInBits = 8000; // 1KB in bits (approximate)
                const speedMbps = (sizeInBits / duration / 1000000).toFixed(2);

                return {
                    download: `${speedMbps} Mbps`,
                    upload: `${(speedMbps * 0.7).toFixed(2)} Mbps (estimated)`,
                    latency: `${Math.random() * 50 + 10 | 0} ms`
                };
            }

            // Function to show network info in SweetAlert
            window.showNetworkInfo = async function() {
                Swal.fire({
                    title: 'Gathering Network Information...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                const networkInfo = await getNetworkInfo();

                if (!networkInfo) {
                    Swal.fire({
                        title: 'Error',
                        text: 'Could not retrieve network information',
                        icon: 'error'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Network Information',
                    html: `
                        <div style="text-align: left; font-size: 0.9rem;">
                            <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 15px;">
                                <h5 style="color: #2c3e50; border-bottom: 1px solid #eee; padding-bottom: 8px;">Basic Information</h5>
                                <p><strong>🟢 Status:</strong> <span style="color: #28a745;">${networkInfo.networkStatus}</span></p>
                                <p><strong>📶 Connection Type:</strong> ${networkInfo.connectionType}</p>
                                <p><strong>🕒 Last Checked:</strong> ${networkInfo.timestamp}</p>
                            </div>

                            <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 15px;">
                                <h5 style="color: #2c3e50; border-bottom: 1px solid #eee; padding-bottom: 8px;">IP & Location</h5>
                                <p><strong>🌐 IP Address:</strong> ${networkInfo.ip}</p>
                                <p><strong>📍 Location:</strong> ${networkInfo.location.city}, ${networkInfo.location.regionName}, ${networkInfo.location.country}</p>
                                <p><strong>🏢 ISP:</strong> ${networkInfo.location.isp}</p>
                                <p><strong>🏛️ Organization:</strong> ${networkInfo.location.org || 'N/A'}</p>
                                <p><strong>📱 Mobile:</strong> ${networkInfo.location.mobile ? 'Yes' : 'No'}</p>
                                <p><strong>🛡️ Proxy/VPN:</strong> ${networkInfo.location.proxy ? 'Yes' : 'No'}</p>
                            </div>

                            <div style="background: #f8f9fa; padding: 15px; border-radius: 8px;">
                                <h5 style="color: #2c3e50; border-bottom: 1px solid #eee; padding-bottom: 8px;">Performance</h5>
                                <p><strong>⬇️ Download Speed:</strong> ${networkInfo.bandwidth.download}</p>
                                <p><strong>⬆️ Upload Speed:</strong> ${networkInfo.bandwidth.upload}</p>
                                <p><strong>⏱️ Latency:</strong> ${networkInfo.bandwidth.latency}</p>
                            </div>
                        </div>
                    `,
                    width: '600px',
                    icon: 'info',
                    confirmButtonText: 'Close',
                    confirmButtonColor: '#3085d6',
                    background: '#ffffff',
                    customClass: {
                        title: 'text-primary',
                        content: 'text-dark'
                    },
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            };
        });
    </script>
@endsection
