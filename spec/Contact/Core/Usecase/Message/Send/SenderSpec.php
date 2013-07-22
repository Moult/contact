<?php

namespace spec\Contact\Core\Usecase\Message\Send;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SenderSpec extends ObjectBehavior
{
    /**
     * @param Contact\Core\Data\Person $person
     * @param Contact\Core\Tool\Validator $validator
     */
    function let($person, $validator)
    {
        $person->name = 'name';
        $person->email = 'email';
        $this->beConstructedWith($person, $validator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Contact\Core\Usecase\Message\Send\Sender');
    }

    function it_should_be_a_person()
    {
        $this->shouldHaveType('Contact\Core\Data\Person');
    }

    function it_can_validate($validator)
    {
        $validator->setup(array(
            'name' => 'name',
            'email' => 'email'
        ))->shouldBeCalled();
        $validator->rule('name', 'not_empty')->shouldBeCalled();
        $validator->rule('email', 'not_empty')->shouldBeCalled();
        $validator->rule('email', 'email')->shouldBeCalled();
        $validator->rule('email', 'email_domain')->shouldBeCalled();
        $validator->check()->shouldBeCalled()->willReturn(FALSE);
        $validator->errors()->shouldBeCalled()->willReturn(array('name', 'email'));
        $this->shouldThrow('Contact\Core\Exception\Validation')
            ->duringValidate();
    }

    function it_can_get_name()
    {
        $this->get_name()->shouldReturn('name');
    }

    function it_can_get_email()
    {
        $this->get_email()->shouldReturn('email');
    }
}
