<?php

namespace App\Http\Controllers;

use App\SpfApi\AuthApi;
use App\Store;

class HomeController extends Controller
{
    private $authApi;

    private $data = [];

    public function __construct(AuthApi $authApi, Store $store)
    {
        $this->authApi = $authApi;
    }

    public function getHome() {
        $productsResponse = $this->authApi->callApi('GET', 'admin/products.json');
        $this->data['products'] = $productsResponse['data']['products'] ?? [];
        return view('home', $this->data);
    }

}
