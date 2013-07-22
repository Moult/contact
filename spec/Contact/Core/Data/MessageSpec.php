<?php

namespace spec\Contact\Core\Data;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Contact\Core\Data\Message');
    }

    function it_has_text()
    {
        $this->text->shouldBe(NULL);
    }
}
