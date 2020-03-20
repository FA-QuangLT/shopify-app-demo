<?php

namespace App\Http\Controllers;

use App\SpfApi\AuthApi;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
    private $authApi;

    private $data = [];

    public function __construct(AuthApi $authApi, Store $store)
    {
        $this->authApi = $authApi;
    }

    public function getHome(Request $request) {
        $productsResponse = $this->authApi->callApi('GET', 'admin/products.json');
        $this->data['products'] = $productsResponse['data']['products'] ?? [];
        return view('home', $this->data);
    }

    public function getReport() {
        return view('report');
    }

    public function ajaxReport(Request $request) {
        $params = $request->all();
        (isset($params['from_date'])) ? $params['from_date'] = strtotime($params['from_date']) : $params['from_date'] = now()->toTimeString();
        (isset($params['to_date'])) ? $params['to_date'] = strtotime($params['to_date']) : $params['to_date'] = now()->toTimeString();
        $installedAppList = Redis::zcount('install-app', $params['from_date'], $params['to_date']);
        $uninstallAppList = Redis::zcount('uninstall-app', $params['from_date'], $params['to_date']);
        return response()->json([
            [
                'label' => 'Installed',
                'data' => $installedAppList
            ],
            [
                'label' => 'Uninstalled',
                'data' => $uninstallAppList
            ]
        ]);
    }
}
