<?php

namespace spec\DeForm\Laravel\Adapter;

use Prophecy\Argument;
use PhpSpec\ObjectBehavior;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Validator;

class ValidatorAdapterSpec extends ObjectBehavior
{

    function let(Validator $validator)
    {
        $this->beConstructedWith($validator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DeForm\Laravel\Adapter\ValidatorAdapter');
        $this->shouldImplement('DeForm\Validation\ValidatorInterface');
    }

    function it_validates_data(Validator $validator, MessageBag $bag)
    {
        $data = [
            'name' => 'Foo',
        ];

        $validator->setData($data)->shouldBeCalled();
        $validator->passes()->willReturn(true);
        $validator->messages()->willReturn($bag);

        $bag->all()->willReturn([]);

        $this->validate($data)->shouldReturn(true);
        $this->getMessages()->shouldReturn([]);
    }

    function it_returns_messages_on_failed_validation(Validator $validator, MessageBag $bag)
    {
        $validator->setData($data = [])->shouldBeCalled();
        $validator->passes()->willReturn(false);
        $validator->messages()->willReturn($bag);

        $bag->all()->willReturn($messages = [
            'foo' => 'failed',
        ]);

        $this->validate($data)->shouldReturn(false);
        $this->getMessages()->shouldReturn($messages);
    }
}
