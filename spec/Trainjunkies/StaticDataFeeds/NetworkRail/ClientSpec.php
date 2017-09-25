<?php

namespace spec\Trainjunkies\StaticDataFeeds\NetworkRail;

use Trainjunkies\StaticDataFeeds\Http\Adapter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClientSpec extends ObjectBehavior
{
    const TYPE = 'CIF_ALL_FULL_DAILY';
    const DAY = 'toc-full';

    function it_can_request_a_schedule(Adapter $httpAdapter)
    {
        $this->beConstructedWith($httpAdapter);

        $this->request(self::TYPE, self::DAY);

        $params = [
            'type' => self::TYPE,
            'day' => self::DAY
        ];

        $httpAdapter->get('CifFileAuthenticate', $params)->shouldHaveBeenCalled();
    }
}
