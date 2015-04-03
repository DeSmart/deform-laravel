<?php namespace DeForm\Laravel\Adapter;

use Illuminate\Http\Request;
use DeForm\Request\RequestInterface;

class RequestAdapter implements RequestInterface
{

    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get($value)
    {
        return $this->request->get($value);
    }

    public function file($name)
    {
        return $this->request->file($name);
    }
}
