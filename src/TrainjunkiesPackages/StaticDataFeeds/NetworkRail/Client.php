<?php

namespace TrainjunkiesPackages\StaticDataFeeds\NetworkRail;

use TrainjunkiesPackages\StaticDataFeeds\Http\Adapter as HttpAdapter;

class Client
{
    /**
     * @var HttpAdapter
     */
    private $httpAdapter;

    public function __construct(HttpAdapter $httpAdapter)
    {
        $this->httpAdapter = $httpAdapter;
    }

    public function request($type, $day)
    {
        return $this->httpAdapter->get('CifFileAuthenticate', [
            'type' => $type,
            'day'  => $day
        ]);
    }
}
