<?php

namespace Menuia;

class Message
{

    public static $phone = NULL;

    public static $message = NULL;

    public static $type = 'text';

    public static $file_url = NULL;

    public static function send()
    {
        try {
            if (self::$phone == NULL || self::$phone == '') {
                Settings::showError((object) ['error' => true, 'message' => 'phone cannot be empty']);
            }

            if (self::$message == NULL || self::$message == '') {
                Settings::showError((object) ['error' => true, 'message' => 'message cannot be empty']);
            }

            switch (self::$type) {
                case 'text':
                    return self::text();
                case 'media':
                    return self::media();
                default:
                    return self::text();
            }

        } catch (\Exception $e) {
            Settings::showError($e);
        }
    }


    public static function text()
    {
        try {
            $client = new \GuzzleHttp\Client();
            $options = [
                'multipart' => [
                    ['name' => 'appkey', 'contents' => Settings::getAppkey()],
                    ['name' => 'authkey', 'contents' => Settings::getAuthkey()],
                    ['name' => 'to', 'contents' => self::$phone],
                    ['name' => 'message', 'contents' => self::$message]
                ]
            ];
            $request = new \GuzzleHttp\Psr7\Request('POST', Settings::getEndpoint() . '/api/create-message');
            $res = $client->sendAsync($request, $options)->wait();

            $statusCode = $res->getStatusCode(); // Obtendo o status da resposta
            $body = $res->getBody()->getContents(); // Obtendo o corpo da resposta como string

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

    public static function media()
    {
        try {

            $validMedia = self::validadeMediaURL(self::$file_url);

            if(!$validMedia){
               return false; 
            }

            $client = new \GuzzleHttp\Client();
            $options = [
                'multipart' => [
                  ['name' => 'appkey', 'contents' => Settings::getAppkey()],
                  ['name' => 'authkey','contents' => Settings::getAuthkey()],
                  ['name' => 'to', 'contents' => self::$phone],
                  ['name' => 'message', 'contents' => $validMedia],
                  ['name' => 'file', 'contents' => self::$file_url],
              ]];


            if (self::$message != NULL && self::$message != '') {
                $options['multipart'][] = ['name' => 'descricao', 'contents' => self::$message];
            }
              
            $request = new \GuzzleHttp\Psr7\Request('POST', Settings::getEndpoint() . '/api/create-message');
            $res = $client->sendAsync($request, $options)->wait();

            $statusCode = $res->getStatusCode(); // Obtendo o status da resposta
            $body = $res->getBody()->getContents(); // Obtendo o corpo da resposta como string

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

    public static function validadeMediaURL(?string $url){
        try {

            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                Settings::showError((object) ['error' => true, 'message' => 'Enter a valid media URL']);
                return false;
            }

            $file_name = basename($url);

            if($file_name != ""){
                return $file_name;
            }

            return false;
            
        } catch (\Exception $e) {
            Settings::showError($e);
        }
    }

}
