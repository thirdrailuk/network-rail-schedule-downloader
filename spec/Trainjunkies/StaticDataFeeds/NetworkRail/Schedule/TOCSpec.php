<?php

namespace spec\Trainjunkies\StaticDataFeeds\NetworkRail\Schedule;

use Trainjunkies\StaticDataFeeds\NetworkRail\Schedule\TOC;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TOCSpec extends ObjectBehavior
{
    function it_has_type_from_valid_code()
    {
        $this->beConstructedFromCode('VT');
        $this->shouldHaveType(TOC::class);
        $this->full()->shouldBe('CIF_VT_TOC_FULL_DAILY');
        $this->update()->shouldBe('CIF_VT_TOC_UPDATE_DAILY');

    }

    function it_will_throw_exception_for_invalid_code_format()
    {
        $this->beConstructedFromCode('   vt');
        $this->shouldThrow(\InvalidArgumentException::class)->duringInstantiation();
    }
}
