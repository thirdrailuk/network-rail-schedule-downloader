<?php

namespace Trainjunkies\StaticDataFeeds\Http;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Cookie\CookieJar;
use Trainjunkies\StaticDataFeeds\NetworkRail\Authentication;

class GuzzleAdapter implements Adapter
{
    /**
     * @var Authentication
     */
    private $authentication;
    /**
     * @var GuzzleHttpClient
     */
    private $guzzleClient;
    /**
     * @var CookieJar
     */
    private $cookieJar;

    public function __construct(
        Authentication $authentication,
        GuzzleHttpClient $guzzleClient,
        CookieJar $cookieJar
    ) {
        $this->authentication = $authentication;
        $this->guzzleClient = $guzzleClient;
        $this->cookieJar = $cookieJar;
    }

    public function get($uri, $params = [], $headers = [])
    {
        $options = $this->requestOptions($params, $headers);

        return $this->guzzleClient->get($uri, $options);
    }

    /**
     * @param $params
     * @param $headers
     *
     * @return array
     */
    private function requestOptions($params, $headers)
    {
        return [
            'base_uri' => Adapter::BASE_URI,
            'query'    => $params,
            'headers'  => $headers,
            'auth'     => [
                $this->authentication->username(),
                $this->authentication->password(),
                'basic'
            ],
            'stream'   => true,
            'cookie'   => $this->cookieJar
        ];
    }
}
