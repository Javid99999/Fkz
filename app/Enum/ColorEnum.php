<?php

namespace App\Enum;

enum ColorEnum: string
{
    case Blue = 'blue';
    case Red = 'red';
    case Green = 'green';
    case Yellow = 'yellow';
    case Orange = 'orange';
    case Purple = 'purple';
    case Pink = 'pink';
    case Teal = 'teal';
    case Indigo = 'indigo';
    case Cyan = 'cyan';
    case Lime = 'lime';
    case Gray = 'gray';

    public function tailwind(): string
    {
        return match ($this) {
            self::Blue => 'blue-500',
            self::Red => 'red-500',
            self::Green => 'green-500',
            self::Yellow => 'yellow-500',
            self::Orange => 'orange-500',
            self::Purple => 'purple-500',
            self::Pink => 'pink-500',
            self::Teal => 'teal-500',
            self::Indigo => 'indigo-500',
            self::Cyan => 'cyan-500',
            self::Lime => 'lime-500',
            self::Gray => 'gray-500',
        };
    }

    public function background(): string
    {
        return 'bg-' . str_replace('-500', '-50', $this->tailwind());
    }

    public function border(): string
    {
        return 'border-' . $this->tailwind();
    }
}
