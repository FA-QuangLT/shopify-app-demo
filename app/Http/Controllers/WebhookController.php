<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class WebhookController extends Controller
{

    private $hmac_header;

    private $data;

    private $store;

    public function __construct(Store $store)
    {
        $this->store = $store;
    }

    public function verifyWebhook($data, $hmac_header) {
        $calculated_hmac = base64_encode(hash_hmac('sha256', $data, config('shopify.secret_key'), true));
        return hash_equals($hmac_header, $calculated_hmac);
    }

    public function createProduct(Request $request) {
        Log::info('create-product', $request->all());
        return true;
    }

    public function updateProduct(Request $request) {
        Log::info('update-product', $request->all());
        return true;
    }

    public function deleteProduct(Request $request) {
        $params = $request->all();
        Log::info('delete-product', $params);
        Redis::zadd('delete-product', now()->timestamp, $params['id']);
        return true;
    }

    public function uninstallApp(Request $request) {
        $params = $request->all();
        Log::info('uninstall-app', $params);
        Redis::zadd('uninstall-app', now()->timestamp, $params['name']);
        $request->session()->forget('store');
        $this->store->remove($params['name']);
        return true;
    }
}
