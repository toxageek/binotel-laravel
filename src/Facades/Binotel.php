<?php

namespace Toxageek\BinotelLaravel\Facades;

use Illuminate\Support\Facades\Facade;

class Binotel extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'Binotel';
    }
}
