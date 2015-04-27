<?php

namespace spec\DeForm\Laravel;

use Prophecy\Argument;
use PhpSpec\ObjectBehavior;
use Illuminate\Validation\Factory;
use Illuminate\Validation\Validator;

class ValidatorFactorySpec extends ObjectBehavior
{

    function let(Factory $factory)
    {
        $this->beConstructedWith($factory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DeForm\Laravel\ValidatorFactory');
        $this->shouldImplement('DeForm\Validation\ValidatorFactoryInterface');
    }

    function it_creates_validator(Factory $factory, Validator $validator)
    {
        $rules = [
            'foo' => 'required',
        ];

        $factory->make([], $rules)->willReturn($validator);

        $this->make($rules)->shouldHaveType('DeForm\Laravel\Adapter\ValidatorAdapter');
    }
}
