<?php

namespace Menuia;

class Device
{

    public static $appKey = NULL;
    public static $webhook = false;

    public static function create() // create and get qrcode
    {
        try {
            if (self::$appKey == NULL || self::$appKey == '') {
                Settings::showError((object) ['error' => true, 'message' => 'device_token cannot be empty']);
            }
 
            $client = new \GuzzleHttp\Client();
            $options = [
                'multipart' => [
                    ['name' => 'authkey', 'contents' => Settings::getAuthkey()],
                    ['name' => 'message', 'contents' => self::$appKey],
                    ['name' => 'conecteQR', 'contents' => true]
                ]
            ];
            
            if (self::$webhook !== false) {
                $options['multipart'][] = ['name' => 'webhook', 'contents' => self::$webhook];
            }

            $request = new \GuzzleHttp\Psr7\Request('POST', Settings::getEndpoint() . '/api/developer');
            $res = $client->sendAsync($request, $options)->wait();
            
            $statusCode = $res->getStatusCode();
            $body = $res->getBody()->getContents();
 

            if ($statusCode == 200) {
                $json = json_decode($body);

                if ($json && isset($json->status) && $json->status == 200) {
                    return $json;
                }
            }

            Settings::showError((object) ['error' => true, 'message' => 'api request', 'response' => $body]);

        } catch (\Exception $e) {
            Settings::showError($e);
        }
    }

 


}
