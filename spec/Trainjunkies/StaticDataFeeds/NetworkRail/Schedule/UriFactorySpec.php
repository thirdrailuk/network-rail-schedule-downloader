<?php

namespace spec\Trainjunkies\StaticDataFeeds\NetworkRail\Schedule;

use GuzzleHttp\Psr7\Uri;
use Trainjunkies\StaticDataFeeds\NetworkRail\Schedule\UriFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UriFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $uri = new Uri('CifFileAuthenticate');
        $uri = Uri::withQueryValue($uri, 'type', 'CIF_ALL_FULL_DAILY');
        $uri = Uri::withQueryValue($uri, 'day', 'toc-full');


        $this->shouldHaveType(UriFactory::class);
        $this->createUri('CIF_ALL_FULL_DAILY', 'toc-full')->shouldBeLike($uri);
    }
}
