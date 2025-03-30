<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\WorkOSService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkOSController extends Controller
{
    protected $workos;

    public function __construct(WorkOSService $workos)
    {
        $this->workos = $workos;
    }

    public function redirect()
    {
        return redirect($this->workos->getAuthorizationUrl());
    }

    public function callback()
    {
        try {
            $profile = $this->workos->getUserProfile(request('code'));

            // Find or create user
            $user = User::firstOrCreate(
                ['email' => $profile->email],
                [
                    'name' => $profile->firstName . ' ' . $profile->lastName,
                    'password' => bcrypt(str_random(16))
                ]
            );

            Auth::login($user);

            return redirect('/dashboard');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Authentication failed: ' . $e->getMessage());
        }
    }
}
