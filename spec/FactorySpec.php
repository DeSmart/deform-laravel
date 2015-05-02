<?php

namespace spec\DeForm\Laravel;

use DeForm\DeForm;
use Prophecy\Argument;
use PhpSpec\ObjectBehavior;
use DeForm\Factory\FormFactory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory as ViewFactory;

class FactorySpec extends ObjectBehavior
{

    function let(ViewFactory $viewFactory, FormFactory $formFactory)
    {
        $this->beConstructedWith($viewFactory, $formFactory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DeForm\Laravel\Factory');
    }

    function it_makes_form_object(ViewFactory $viewFactory, FormFactory $formFactory, View $view, DeForm $form)
    {
        $viewFactory->make($view_name = 'forms.foo', $data = ['foo' => true])
            ->willReturn($view);

        $view->render()->willReturn($html = '<form></form>');
        $formFactory->make($html)->willReturn($form);

        $this->make($view_name, $data)->shouldReturn($form);
    }
}
