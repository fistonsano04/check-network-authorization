<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use function Illuminate\Log\log;

class NetworkController extends Controller
{
    public function validateNetwork(Request $request)
    {
        // Get the real external IP of the user
        $userIP = $request->ip();

        // Alternative: Get public IP using an external API
        try {
            $response = Http::get('https://api64.ipify.org?format=json');
            $data = $response->json();
            if (isset($data['ip'])) {
                $userIP = $data['ip'];
            }
        } catch (Exception $e) {
            // Log error but continue using request IP
            log::error("Failed to fetch public IP: " . $e->getMessage());
        }
 

        return response()->json(['IP' => $userIP]);
    }
}
