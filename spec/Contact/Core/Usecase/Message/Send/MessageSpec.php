<?php

namespace spec\Contact\Core\Usecase\Message\Send;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MessageSpec extends ObjectBehavior
{
    /**
     * @param Contact\Core\Data\Message $message
     * @param Contact\Core\Tool\Emailer $emailer
     * @param Contact\Core\Tool\Formatter $formatter
     * @param Contact\Core\Tool\Validator $validator
     */
    function let($message, $emailer, $formatter, $validator)
    {
        $message->text = 'text';
        $this->beConstructedWith($message, $emailer, $formatter, $validator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Contact\Core\Usecase\Message\Send\Message');
    }

    function it_should_be_a_message()
    {
        $this->shouldHaveType('Contact\Core\Data\Message');
    }

    function it_validates_the_message($validator)
    {
        $validator->setup(array(
            'text' => 'text'
        ))->shouldBeCalled();
        $validator->add_required_rule('text')->shouldBeCalled();
        $validator->is_valid()->shouldBeCalled()->willReturn(FALSE);
        $validator->get_error_keys()->shouldBeCalled()->willReturn(array('text'));
        $this->shouldThrow('Contact\Core\Exception\Validation')
            ->duringValidate();
    }

    function it_sends_from_sender_details($emailer, $formatter)
    {
        $formatter->setup(array(
            'message_text' => 'text',
            'sender_name' => 'sender_name',
            'sender_email' => 'sender_email'
        ))->shouldBeCalled();
        $formatter->format('Email_Message_Send_Subject')->shouldBeCalled()->willReturn('email_subject');
        $formatter->format('Email_Message_Send_Body')->shouldBeCalled()->willReturn('email_body');
        $emailer->set_from(array('sender_email' => 'sender_name'))->shouldBeCalled();
        $emailer->set_subject('email_subject')->shouldBeCalled();
        $emailer->set_body('email_body')->shouldBeCalled();
        $emailer->send()->shouldBeCalled();
        $this->send_from('sender_name', 'sender_email');
    }
}
