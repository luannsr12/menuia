<?php 

namespace Menuia;

class Settings {
    
    /*type string*/
    public static $appkey = NULL;

    /*type string*/
    public static $authkey = NULL;

    /*type string*/
    public static $endpoint = NULL;

    /*type bool*/
    public static $debug = false;

    /*type bool*/
    public static $error = false;

    /*type object*/
    public static $error_info = [];

    public static function setAppkey(?string $appkey): bool {
        self::$appkey = $appkey;
        return self::$appkey ? true : false;
    }

    public static function setAuthkey(?string $authkey): bool {
        self::$authkey = $authkey;
        return self::$authkey ? true : false;
    }

    public static function setEndpoint(?string $endpoint): bool {
        self::$endpoint = $endpoint;
        return self::$endpoint ? true : false;
    }

    public static function debug(bool $debug): bool {
        self::$debug = $debug;
        return self::$debug ? true : false;
    }

    public static function getAppkey() {
        return self::$appkey;
    }

    public static function getAuthkey(){
        return self::$authkey;
    }

    public static function getEndpoint() {
        return self::$endpoint;
    }

    public static function get(): object {
        return (object)[
            'appkey' => self::$appkey,
            'authkey' => self::$appkey,
            'endpoint' => self::$endpoint,
            'debug' => self::$debug
        ];
    }

    public static function showError(object $e = new \stdClass) {

        self::$error = true;
        self::$error_info = $e;

        if (self::$debug == true) { 
            print_r($e);
            die;
        } else {
            return false;
        }
    }
}
