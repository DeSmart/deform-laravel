<?php namespace DeForm\Laravel;

use DeForm\Laravel\Adapter\ValidatorAdapter;
use DeForm\Validation\ValidatorFactoryInterface;
use Illuminate\Validation\Factory as ValidationFactory;

class ValidatorFactory implements ValidatorFactoryInterface
{

    /**
     * @var \Illuminate\Validation\Factory
     */
    protected $factory;

    public function __construct(ValidationFactory $factory)
    {
        $this->factory = $factory;
    }

    public function make(array $rules)
    {
        $validator = $this->factory->make([], $rules);

        return new ValidatorAdapter($validator);
    }
}
