<?php namespace DeForm\Laravel;

use DeForm\Factory\FormFactory;
use Illuminate\Contracts\View\Factory as ViewFactory;

class Factory
{

    protected $viewFactory;

    protected $formFactory;

    public function __construct(ViewFactory $viewFactory, FormFactory $formFactory)
    {
        $this->viewFactory = $viewFactory;
        $this->formFactory = $formFactory;
    }

    public function make($viewName, array $data = [])
    {
        $view = $this->viewFactory->make($viewName, $data);

        return $this->formFactory->make($view->render());
    }
}
