<?php namespace DeForm\Laravel;

class Facade extends \Illuminate\Support\Facades\Facade
{

    protected static function getFacadeAccessor()
    {
        return 'deform';
    }
}
