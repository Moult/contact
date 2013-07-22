<?php

namespace spec\Contact\Core\Data;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PersonSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Contact\Core\Data\Person');
    }

    function it_has_a_name()
    {
        $this->name->shouldBe(NULL);
    }

    function it_has_an_email()
    {
        $this->email->shouldBe(NULL);
    }
}
