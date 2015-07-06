<?php namespace DeForm\Laravel\Adapter;

use Illuminate\Validation\Validator;
use DeForm\Validation\ValidatorInterface;

class ValidatorAdapter implements ValidatorInterface
{

    protected $validator;

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function validate(array $values)
    {
        $this->validator->setData($values);

        return $this->validator->passes();
    }

    public function getMessages()
    {
        return $this->validator->getMessageBag()
            ->toArray();
    }
}
