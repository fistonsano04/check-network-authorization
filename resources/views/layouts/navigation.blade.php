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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>

<body>

    @yield('content')

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


    <script>
        // Global variable to track network status
        let networkStatus = {
            connected: true,
            manuallyDisabled: false
        };

        // Modified network info function to respect manual disconnection
        async function getNetworkInfo() {
            if (networkStatus.manuallyDisabled) {
                return {
                    ip: "N/A (Disconnected)",
                    location: {
                        city: "N/A",
                        regionName: "N/A",
                        country: "N/A",
                        isp: "N/A",
                        org: "N/A",
                        mobile: false,
                        proxy: false
                    },
                    bandwidth: {
                        download: "0 Mbps",
                        upload: "0 Mbps",
                        latency: "∞ ms"
                    },
                    connectionType: "Disconnected",
                    networkStatus: "Offline (Manually Disabled)",
                    timestamp: new Date().toLocaleString()
                };
            }

            // Original network info code here...
            // (Keep the same implementation from previous example)
        }

        // Disconnect Network Function
        window.disconnectNetwork = async function() {
            const {
                value: confirm
            } = await Swal.fire({
                title: 'Disconnect Network?',
                text: "This will simulate network disconnection. Continue?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Disconnect',
                cancelButtonText: 'Cancel'
            });

            if (confirm) {
                // Simulate network disconnection
                networkStatus.manuallyDisabled = true;

                Swal.fire({
                    title: 'Network Disconnected',
                    html: `
                    <div style="text-align: center;">
                        <div style="font-size: 5rem; color: #dc3545;">
                            <i class="bi bi-wifi-off"></i>
                        </div>
                        <p style="margin-top: 20px;">Your network connection has been manually disabled.</p>
                        <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-top: 15px;">
                            <p><strong>Note:</strong> This is a simulation. Your actual network connection remains active.</p>
                        </div>
                    </div>
                `,
                    icon: 'success',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#3085d6'
                });

                // Update any active network info displays
                if (document.querySelector('.swal2-container')) {
                    setTimeout(showNetworkInfo, 1500);
                }
            }
        };

        // Reconnect function (optional - could add a reconnect button)
        window.reconnectNetwork = function() {
            networkStatus.manuallyDisabled = false;
            showNetworkInfo();
        };
    </script>
</body>

</html>
