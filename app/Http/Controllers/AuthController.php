<?php

namespace App\Http\Controllers;

use App\SpfApi\AuthApi;
use App\Store;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $authApi;

    private $store;

    public function __construct(AuthApi $authApi, Store $store)
    {
        $this->authApi = $authApi;
        $this->store = $store;
    }

    public function index() {
        return view('welcome');
    }

    public function install(Request $request)
    {
        if (!$request->store_name) {
            return back()->with('message', 'Fill store name!');
        }
        $url = $this->authApi->urlInstall($request->store_name);
        return redirect($url);
    }

    public function getAuth(Request $request) {
        $params = $request->all();
        $verifyResult = $this->authApi->verifyRequest($params);
        if ($verifyResult) {
            $params['name'] = explode('.', $params['shop'])[0];
            $tokenResult = $this->authApi->getAccessToken($params['name'], $params['code']);
            if ($tokenResult['status']) {
                $params['access_token'] = $tokenResult['data']['access_token'];
                $params['domain'] = $params['shop'];
                $this->store->saveToken($params);
                session()->put('store', $params);
                return redirect('/home');
            }
            return $tokenResult;
        }
        return back()->with('error', 'request fail!');
    }

    public function logout(Request $request) {
        $request->session()->forget('store');
//        dd(session('store'));
        return redirect('/');
    }
}
