<?php namespace DeForm\Laravel;

use DeForm\ValidationHelper;
use DeForm\Parser\HtmlParser;
use DeForm\Factory\FormFactory;
use DeForm\Factory\ElementFactory;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    protected $defer = true;

    public function register()
    {
        $this->app->singleton('deform', function ($app) {
            return new Factory($app['view'], $app['deform.form_factory']);
        });

        $this->app->bind('deform.form_factory', function ($app) {
            return new FormFactory(
                $app['request'],
                $app['deform.validator'],
                $app['deform.element_factory'],
                $app['deform.parser']
            );
        });

        $this->app->bind('deform.validator', function ($app) {
            return new ValidationHelper(
                new ValidatorFactory($app['validator'])
            );
        });

        $this->app->bind('deform.element_factory', function ($app) {
            return new ElementFactory($app['request']);
        });

        $this->app->bind('deform.parser', function () {
            return new HtmlParser;
        });
    }

    public function provides()
    {
        return ['deform'];
    }
}
