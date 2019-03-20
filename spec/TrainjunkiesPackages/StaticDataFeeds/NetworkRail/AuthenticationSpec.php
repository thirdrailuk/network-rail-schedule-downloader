<?php

namespace spec\TrainjunkiesPackages\StaticDataFeeds\NetworkRail;

use TrainjunkiesPackages\StaticDataFeeds\NetworkRail\Authentication;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AuthenticationSpec extends ObjectBehavior
{
    const USERNAME = 'dave';
    const PASSWORD = '$ecr£t';

    function it_has_username_and_password()
    {
        $this->beConstructedFromUsernameAndPassword(self::USERNAME, self::PASSWORD);
        $this->username()->shouldBe(self::USERNAME);
        $this->password()->shouldBe(self::PASSWORD);
    }

    function it_should_throw_exception_when_missing_username_and_password()
    {
        $this->beConstructedFromUsernameAndPassword('', '');
        $this->shouldThrow(\Exception::class)->duringInstantiation();
    }

    function it_should_throw_exception_when_missing_username()
    {
        $this->beConstructedFromUsernameAndPassword('', self::PASSWORD);
        $this->shouldThrow(\Exception::class)->duringInstantiation();
    }

    function it_should_throw_exception_when_missing_password()
    {
        $this->beConstructedFromUsernameAndPassword(self::USERNAME, '');
        $this->shouldThrow(\Exception::class)->duringInstantiation();
    }


}
