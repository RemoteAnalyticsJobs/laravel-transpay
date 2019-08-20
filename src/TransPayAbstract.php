<?php
namespace TransPay;


use GuzzleHttp\Client;

abstract class TransPayAbstract {

    /** @var Client */
    public $_httpClient;

    /** @var string */
    public $_apiKey;

    /** @var string  */
    public static $LIVE_URL = 'https://send.transfast.ws';

    /** @var string  */
    public static $SANDBOX_URL = 'https://demo-api.transfast.net/';

    /**
     * TransPayAbstract constructor.
     * @param null $client
     */
    public function __construct($client = null) {
        $this->_setHttpClient($client);
        $apiToken = $this->_getApiKey();
        $this->_setApiKey($apiToken);
    }

    /**
     * @param $client
     * @return TransPayAbstract
     */
    public function _setHttpClient($client) : TransPayAbstract {
        if (is_null($client)) {
            $this->_httpClient = new Client([
                'base_url' => self::_getBaseUrl()
            ]);
            return $this;
        }
        $this->_httpClient = $client;
        return $this;
    }

    /**
     * @param string $apiKey
     * @return TransPayAbstract
     */
    public function _setApiKey(string $apiKey) : TransPayAbstract {
        $this->_apiKey = $apiKey;
        return $this;
    }

    /**
     * @return string
     */
    public static function _getBaseUrl() {
        if (app()->environment() == 'testing') {
            return self::$SANDBOX_URL;
        }

        return self::$LIVE_URL;
    }

    /**
     * It will return token according to environment
     * @return \Illuminate\Config\Repository|mixed
     */
    public function _getApiKey() {
        if (app()->environment() == 'testing' || app()->environment() == 'local') {
            return config('transpay.SANDBOX_TOKEN');
        }
        return config('transpay.LIVE_TOKEN');
    }


}
