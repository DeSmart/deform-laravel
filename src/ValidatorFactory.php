<?php namespace DeForm\Laravel;

use Illuminate\Validation\Factory;
use DeForm\Laravel\Adapter\ValidatorAdapter;
use DeForm\Validation\ValidatorFactoryInterface;

class ValidatorFactory implements ValidatorFactoryInterface
{

    /**
     * @var \Illuminate\Validation\Factory
     */
    protected $factory;

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    public function make(array $rules)
    {
        $validator = $this->factory->make([], $rules);

        return new ValidatorAdapter($validator);
    }
}
