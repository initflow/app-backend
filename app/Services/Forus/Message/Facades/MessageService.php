<?php

namespace App\Services\Forus\Message\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class MessageService
 * @package App\Services\Forus\Message\Facades
 */
class MessageService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'forus.services.message';
    }
}