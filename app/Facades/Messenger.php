<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
/**
 * @see \Illuminate\Validation\Factory
 */
class Messenger extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Message\Messenger';
    }
}
