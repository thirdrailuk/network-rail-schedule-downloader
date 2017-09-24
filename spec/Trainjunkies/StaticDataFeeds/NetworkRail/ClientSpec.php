<?php

namespace spec\Trainjunkies\StaticDataFeeds\NetworkRail;

use Trainjunkies\StaticDataFeeds\NetworkRail\Authentication;
use Trainjunkies\StaticDataFeeds\NetworkRail\ClientBuilder;
use Trainjunkies\StaticDataFeeds\NetworkRail\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Trainjunkies\StaticDataFeeds\NetworkRail\Schedule\UriFactory;

class ClientSpec extends ObjectBehavior
{
    const TYPE = 'CIF_ALL_FULL_DAILY';
    const DAY = 'toc-full';

    function it_is_initializable(
        \GuzzleHttp\Client $httpClient,
        UriFactory $uriFactory
    ) {
        $uriFactory->createUri(self::TYPE, self::DAY)->willReturn('a-uri');

        $this->beConstructedWith(
            $httpClient,
            $uriFactory,
            []
        );

        $this->shouldHaveType(Client::class);

        $this->request(self::TYPE, self::DAY);

        $uriFactory->createUri(self::TYPE, self::DAY)->shouldHaveBeenCalled();

        $httpClient->request('GET', 'a-uri', [])->shouldHaveBeenCalled();
    }
}
