<?php

namespace spec\Trainjunkies\StaticDataFeeds\NetworkRail\Schedule;

use Trainjunkies\StaticDataFeeds\NetworkRail\Schedule\Day;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DaySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedFromDayString('mon');
        $this->shouldHaveType(Day::class);
    }

    function it_will_throw_exception_for_invalid_days()
    {
        $this->beConstructedFromDayString('xxx');
        $this->shouldThrow(\Exception::class)->duringInstantiation();
    }

    function it_can_return_sun_from_mon()
    {
        $this->beConstructedFromDayString('mon');
        $this->__toString()->shouldBe('toc-update-sun');
    }

    function it_can_return_mon_from_tue()
    {
        $this->beConstructedFromDayString('tue');
        $this->__toString()->shouldBe('toc-update-mon');
    }

    function it_can_return_tue_from_wed()
    {
        $this->beConstructedFromDayString('wed');
        $this->__toString()->shouldBe('toc-update-tue');
    }

    function it_can_return_wed_from_thu()
    {
        $this->beConstructedFromDayString('thu');
        $this->__toString()->shouldBe('toc-update-wed');
    }

    function it_can_return_thu_from_fri()
    {
        $this->beConstructedFromDayString('fri');
        $this->__toString()->shouldBe('toc-update-thu');
    }

    function it_can_return_fri_from_sat()
    {
        $this->beConstructedFromDayString('sat');
        $this->__toString()->shouldBe('toc-update-fri');
    }

    function it_can_return_sat_from_sun()
    {
        $this->beConstructedFromDayString('sun');
        $this->__toString()->shouldBe('toc-update-sat');
    }
}
