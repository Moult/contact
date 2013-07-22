<?php

namespace spec\Contact\Core\Usecase\Message\Send;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InteractorSpec extends ObjectBehavior
{
    /**
     * @param Contact\Core\Usecase\Message\Send\Message $message
     * @param Contact\Core\Usecase\Message\Send\Sender $sender
     */
    function let($message, $sender)
    {
        $this->beConstructedWith($message, $sender);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Contact\Core\Usecase\Message\Send\Interactor');
    }

    function it_runs_the_interaction_chain($message, $sender)
    {
        $sender->validate()->shouldBeCalled();
        $message->validate()->shouldBeCalled();
        $sender->get_name()->shouldBeCalled()->willReturn('sender_name');
        $sender->get_email()->shouldBeCalled()->willReturn('sender_email');
        $message->send_from('sender_name', 'sender_email')->shouldBeCalled();
        $this->interact();
    }
}
