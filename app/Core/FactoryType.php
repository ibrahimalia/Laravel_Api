<?php

namespace App\Core;

class FactoryType{

    public static function factory(string $type)
	{
        switch ($type) {
            case 'admin':
                return new Admin();
                break;
            case 'user':
                return new User();
                break;
            default:
                return new User();
        }

	}

}
