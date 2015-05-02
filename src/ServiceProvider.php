<?php namespace DeForm\Laravel;

use DeForm\ValidationHelper;
use DeForm\Factory\FormFactory;
use DeForm\Factory\ElementFactory;
use DeForm\Factory\HtmlParserFactory;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    protected $defer = true;

    public function register()
    {
        $this->app->bind('deform', function ($app) {
            return new Factory($app['view'], $app['deform.form_factory']);
        });

        $this->app->bind('deform.form_factory', function ($app) {
            return new FormFactory(
                new Adapter\RequestAdapter($app['request']),
                $app['deform.validator'],
                $app['deform.element_factory'],
                $app['deform.parser_factory']
            );
        });

        $this->app->bind('deform.validator', function ($app) {
            return new ValidationHelper(
                new ValidatorFactory($app['validator'])
            );
        });

        $this->app->bind('deform.element_factory', function ($app) {
            return new ElementFactory(
                new Adapter\RequestAdapter($app['request'])
            );
        });

        $this->app->bind('deform.parser_factory', function () {
            return new HtmlParserFactory;
        });
    }

    public function provides()
    {
        return ['deform'];
    }
}
