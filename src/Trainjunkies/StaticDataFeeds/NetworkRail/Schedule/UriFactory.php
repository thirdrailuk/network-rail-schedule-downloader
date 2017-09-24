<?php

namespace Trainjunkies\StaticDataFeeds\NetworkRail\Schedule;

use GuzzleHttp\Psr7\Uri;

class UriFactory
{
    public function createUri($type, $day)
    {
        $uri = new Uri('CifFileAuthenticate');
        $uri = Uri::withQueryValue($uri, 'type', $type);
        return Uri::withQueryValue($uri, 'day', $day);
    }
}
