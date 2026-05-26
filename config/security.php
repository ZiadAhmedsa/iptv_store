<?php

return [
    'force_https' => env('SECURITY_FORCE_HTTPS', env('APP_ENV') === 'production'),

    'csp' => [
        'enabled' => env('SECURITY_CSP_ENABLED', env('APP_ENV') === 'production'),
        'report_only' => env('SECURITY_CSP_REPORT_ONLY', true),
        'report_uri' => env('SECURITY_CSP_REPORT_URI'),
        'directives' => [
            'default-src' => ["'self'"],
            'base-uri' => ["'self'"],
            'object-src' => ["'none'"],
            'frame-ancestors' => ["'self'"],
            'form-action' => ["'self'"],
            'img-src' => ["'self'", 'data:', 'https:'],
            'font-src' => ["'self'", 'data:', 'https://fonts.gstatic.com'],
            'style-src' => ["'self'", "'unsafe-inline'", 'https://fonts.googleapis.com'],
            'script-src' => ["'self'", "'unsafe-inline'"],
            'connect-src' => ["'self'"],
            'upgrade-insecure-requests' => [],
        ],
    ],
];
