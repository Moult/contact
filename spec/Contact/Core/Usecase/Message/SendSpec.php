<?php

namespace spec\Contact\Core\Usecase\Message;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SendSpec extends ObjectBehavior
{
    /**
     * @param Contact\Core\Data\Message $message
     * @param Contact\Core\Data\Person $person
     * @param Contact\Core\Tool\Emailer $emailer
     * @param Contact\Core\Tool\Formatter $formatter
     * @param Contact\Core\Tool\Validator $validator
     */
    function let($message, $person, $emailer, $formatter, $validator)
    {
        $data = array(
            'message' => $message,
            'person' => $person
        );

        $tools = array(
            'emailer' => $emailer,
            'formatter' => $formatter,
            'validator' => $validator
        );

        $this->beConstructedWith($data, $tools);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Contact\Core\Usecase\Message\Send');
    }

    function it_fetches_the_interactor()
    {
        $this->fetch()->shouldHaveType('Contact\Core\Usecase\Message\Send\Interactor');
    }
}
