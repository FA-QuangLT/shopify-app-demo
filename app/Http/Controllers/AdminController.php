<?php

namespace App\Http\Controllers;

use App\SpfApi\AuthApi;
use App\Store;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $authApi;

    private $data = [];

    public function __construct(AuthApi $authApi, Store $store)
    {
        $this->authApi = $authApi;
    }

    public function index() {
        return $this->authApi->resigterWebhooks('products/create');
    }


}
