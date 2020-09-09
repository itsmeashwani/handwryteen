<?php 

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Osiset\ShopifyApp\Contracts\Objects\Values\ShopDomain;
use Illuminate\Support\Facades\Http;
use stdClass;

class OrdersCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Shop's myshopify domain
     *
     * @var ShopDomain
     */
    public $shopDomain;

    /**
     * The webhook data
     *
     * @var object
     */
    public $data;

    /**
     * Create a new job instance.
     *
     * @param string   $shopDomain The shop's myshopify domain
     * @param stdClass $data    The webhook data (JSON decoded)
     *
     * @return void
     */
    public function __construct($shopDomain, $data)
    {
        $this->shopDomain = $shopDomain;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
    {
        // $hmac = $request->header('x-shopify-hmac-sha256') ?: '';
        // $response = Http::withHeaders([
        //     'X-Shopify-Topic' => 'orders/create',
        //     'X-Shopify-Hmac-Sha256' => $hmac,
        //     'X-Shopify-Shop-Domain' => 'cloud1212.myshopify.com',
        //     'X-Shopify-API-Version' => '2020-07',
        // ])->get('https://cloud1212.myshopify.com/admin/api/2020-07/webhooks.json');

        // print_r($response);
        
        // Do what you wish with the data
        // Access domain name as $this->shopDomain->toNative()
    }
}
