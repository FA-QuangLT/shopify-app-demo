<?php

return [

    'api_key' => env('SPF_API_KEY', 'aaa'),
    'secret_key' => env('SPF_SECRET_KEY', 'bbb'),
    'scope' => [
        'write_orders',
        'read_customers',
        'read_products'
    ],
    'redirect_url' => env('REDRIECT_URL', 'https://463946ce.ngrok.io/auth')

];
