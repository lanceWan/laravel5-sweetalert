<?php
namespace Lance\Sweet\Facade;
use Illuminate\Support\Facades\Facade;
class Sweet extends Facade
{
	protected static function getFacadeAccessor()
    {
        return 'sweet';
    }
}