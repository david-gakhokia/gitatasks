<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $client;
    private $tokenUrl = 'https://oauth2.bog.ge/auth/realms/bog/protocol/openid-connect/token';
    private $clientId = 'your_client_id'; // შეცვალეთ თქვენი მონაცემებით
    private $clientSecret = 'your_client_secret'; // შეცვალეთ თქვენი მონაცემებით

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getAccessToken()
    {
        $response = $this->client->post($this->tokenUrl, [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
            ],
        ]);

        $responseBody = json_decode($response->getBody(), true);

        if (isset($responseBody['access_token'])) {
            return $responseBody['access_token'];
        } else {
            throw new \Exception('Failed to obtain access token');
        }
    }


    public function initiatePayment(Request $request)
    {
        try {
            $accessToken = $this->getAccessToken();

            $response = $this->client->post('https://api.bog.ge/payments/v1/ecommerce/orders', [
                'headers' => [
                    'Accept-Language' => 'ka',
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'callback_url' => 'https://foodly.space/payment/callback',
                    'external_order_id' => uniqid(),
                    'purchase_units' => [
                        'currency' => 'GEL',
                        'total_amount' => $request->amount,
                        'basket' => [
                            [
                                'quantity' => 1,
                                'unit_price' => $request->amount,
                                'product_id' => 'product123', // შეცვალეთ საჭიროებისამებრ
                            ]
                        ]
                    ],
                    'redirect_urls' => [
                        'fail' => 'https://foodly.space/payment/fail',
                        'success' => 'https://foodly.space/payment/success',
                    ]
                ],
            ]);

            $responseBody = json_decode($response->getBody(), true);

            if (isset($responseBody['links']['redirect'])) {
                return redirect($responseBody['links']['redirect']);
            } else {
                return back()->with('error', 'Payment initiation failed.');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function handleCallback(Request $request)
    {
        // Handle the callback from the bank
        // Verify the payment status and update your records accordingly
    }
}
