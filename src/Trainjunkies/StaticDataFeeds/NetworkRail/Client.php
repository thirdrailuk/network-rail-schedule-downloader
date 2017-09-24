<?php

namespace Trainjunkies\StaticDataFeeds\NetworkRail;

use \GuzzleHttp\Client as HttpClient;
use Trainjunkies\StaticDataFeeds\NetworkRail\Schedule\UriFactory;

class Client
{
    /**
     * @var HttpClient
     */
    private $httpClient;
    /**
     * @var Schedule\UriFactory
     */
    private $uriFactory;
    /**
     * @var array
     */
    private $requestOptions = [];

    public function __construct(
        HttpClient $httpClient,
        UriFactory $uriFactory,
        $requestOptions = []
    ) {
        $this->httpClient = $httpClient;
        $this->uriFactory = $uriFactory;
        $this->requestOptions = $requestOptions;
    }

    public function request($type, $day)
    {
        return $this->httpClient->request(
            'GET',
            $this->uriFactory->createUri($type, $day),
            $this->requestOptions
        );
    }
}
