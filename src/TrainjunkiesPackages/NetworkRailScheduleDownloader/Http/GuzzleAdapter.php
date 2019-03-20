<?php

namespace TrainjunkiesPackages\NetworkRailScheduleDownloader\Http;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\ClientException;
use TrainjunkiesPackages\NetworkRailScheduleDownloader\Exception\HttpException;
use TrainjunkiesPackages\NetworkRailScheduleDownloader\Exception\NetworkRailException;
use TrainjunkiesPackages\NetworkRailScheduleDownloader\NetworkRail\Authentication;

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

        try {
            return $this->guzzleClient->get($uri, $options);
        } catch (ClientException $e) {
            if ($e->getCode() === 401) {
                throw NetworkRailException::unauthorized($options['query']['type'], $e);
            }

            throw HttpException::httpError($e);
        }
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
