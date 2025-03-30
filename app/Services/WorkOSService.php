<?php

namespace App\Services;

use WorkOS\WorkOS;
use WorkOS\SSO;

class WorkOSService
{
    protected $workos;
    protected $sso;

    public function __construct()
    {
        $this->workos = new WorkOS(config('workos.api_key'));
        $this->sso = new SSO();
    }

    public function getAuthorizationUrl($provider = null)
    {
        $provider = $provider ?: config('workos.default_provider');

        return $this->sso->getAuthorizationUrl(
            config('workos.client_id'),
            config('workos.redirect_uri'),
            $provider
        );
    }

    public function getUserProfile($code)
    {
        return $this->sso->getProfileAndToken($code);
    }
}
