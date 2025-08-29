<?php

namespace App\Enum;

enum ValueParseType: string
{
    case Text = 'text';
    case Number = 'numeric';


    public function parse(string $value): mixed
    {
        return match($this){
            self::Text => strval($value),
            self::Number => floatval($value),
        };
    }
}