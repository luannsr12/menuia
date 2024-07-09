<?php

namespace Menuia;

class Device
{
    public static $webhook = false;

    public static function qrcode() // create and get qrcode
    {
        try {
            if (Settings::getAppkey() == NULL || Settings::getAppkey() == '') {
                Settings::showError((object) ['error' => true, 'message' => 'appKey cannot be empty']);
            }
 
            $client = new \GuzzleHttp\Client();
            $options = [
                'multipart' => [
                    ['name' => 'authkey', 'contents' => Settings::getAuthkey()],
                    ['name' => 'message', 'contents' => Settings::getAppkey()],
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

  
    public static function remove() // remove device
    {
        try {
            if (Settings::getAppkey() == NULL || Settings::getAppkey() == '') {
                Settings::showError((object) ['error' => true, 'message' => 'appKey cannot be empty']);
            }
 
            $client = new \GuzzleHttp\Client();
            $options = [
                'multipart' => [
                    ['name' => 'authkey', 'contents' => Settings::getAuthkey()],
                    ['name' => 'message', 'contents' => Settings::getAppkey()],
                    ['name' => 'apagarDispositivo', 'contents' => true]
                ]
            ];

            $request = new \GuzzleHttp\Psr7\Request('POST', Settings::getEndpoint() . '/api/developer');
            $res = $client->sendAsync($request, $options)->wait();
            
            $statusCode = $res->getStatusCode();
            $body       = $res->getBody()->getContents();
 

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

    public static function disconnect() // disconnect device
    {
        try {
            if (Settings::getAppkey() == NULL || Settings::getAppkey() == '') {
                Settings::showError((object) ['error' => true, 'message' => 'appKey cannot be empty']);
            }
 
            $client = new \GuzzleHttp\Client();
            $options = [
                'multipart' => [
                    ['name' => 'authkey', 'contents' => Settings::getAuthkey()],
                    ['name' => 'message', 'contents' => Settings::getAppkey()],
                    ['name' => 'desconectar', 'contents' => true]
                ]
            ];

            $request = new \GuzzleHttp\Psr7\Request('POST', Settings::getEndpoint() . '/api/developer');
            $res = $client->sendAsync($request, $options)->wait();
            
            $statusCode = $res->getStatusCode();
            $body       = $res->getBody()->getContents();
 

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


    public static function status() // status device
    {
        try {
            if (Settings::getAppkey() == NULL || Settings::getAppkey() == '') {
                Settings::showError((object) ['error' => true, 'message' => 'appKey cannot be empty']);
            }
 
            $client = new \GuzzleHttp\Client();
            $options = [
                'multipart' => [
                    ['name' => 'authkey', 'contents' => Settings::getAuthkey()],
                    ['name' => 'message', 'contents' => Settings::getAppkey()],
                    ['name' => 'checkDispositivo', 'contents' => true]
                ]
            ];

            $request = new \GuzzleHttp\Psr7\Request('POST', Settings::getEndpoint() . '/api/developer');
            $res = $client->sendAsync($request, $options)->wait();
            
            $statusCode = $res->getStatusCode();
            $body       = $res->getBody()->getContents();
            
            switch ($statusCode) {
                case 200:
                    $json = json_decode($body);
            
                    if ($json && isset($json->status) && $json->status == 200) {
                        return $json;
                    }else if ($json && isset($json->status) && $json->status == 404) {
                        return false;
                    }
                    break;
            
                case 404:
                    return false;
            }
            
            Settings::showError((object) ['error' => true, 'message' => 'api request', 'response' => $body]);

        } catch (\Exception $e) {
            Settings::showError($e);
        }
    }
 
}
