<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'webhook/*',
        'https://c40af651.ngrok.io/webhook/*',
        'http://c40af651.ngrok.io/webhook/*'
    ];
}
