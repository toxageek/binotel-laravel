<?php

namespace Toxageek\BinotelLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Toxageek\BinotelLaravel\BinotelClient
 */
class Binotel extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'Binotel';
    }
}
