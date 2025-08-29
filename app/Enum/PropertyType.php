<?php

namespace App\Enum;

enum PropertyType: string
{
    case Basic = 'basic';
    case Special = 'special';
    
    
    public function labe():string
    {
        return match($this)
        {
            self::Basic => 'Basic',
            self::Special => 'Special',
        };
    }
}