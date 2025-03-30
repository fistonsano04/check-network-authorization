<?php

return [
    'api_key' => env('WORKOS_SECRET'),
    'client_id' => env('WORKOS_KEY'),
    'redirect_uri' => env('WORKOS_REDIRECT_URI'),
    'default_provider' => env('WORKOS_PROVIDER', ''),
];
