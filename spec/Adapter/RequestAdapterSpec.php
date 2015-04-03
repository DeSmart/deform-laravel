<?php

namespace spec\DeForm\Laravel\Adapter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class RequestAdapterSpec extends ObjectBehavior
{

    function let(Request $request)
    {
        $this->beConstructedWith($request);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DeForm\Laravel\Adapter\RequestAdapter');
        $this->shouldImplement('DeForm\Request\RequestInterface');
    }

    function it_gets_value(Request $request)
    {
        $request->get($name = 'foo')->willReturn($value = 'bar');
        $this->get($name)->shouldReturn($value);
    }

    function it_gets_files(Request $request)
    {
        $file = new UploadedFile(__FILE__, basename(__FILE__));
        $request->file($name = 'foo')->willReturn($file);
        $this->file($name)->shouldReturn($file);
    }
}
