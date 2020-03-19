<?php

return [

    'api_key' => env('SPF_API_KEY', 'aaa'),
    'secret_key' => env('SPF_SECRET_KEY', 'bbb'),
    'scope' => [
        'write_orders',
        'read_customers',
        'read_products'
    ],
    'redirect_url' => 'https://4fec7e2c.ngrok.io/auth'

];
