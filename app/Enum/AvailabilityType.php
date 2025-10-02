<?php

namespace App\Enum;

enum AvailabilityType: string
{
    case Country = 'country';
    case Region  = 'region';
    case Port    = 'port';
    case City    = 'city';
    case Global  = 'global';

    /**
     * Kullanıcıya gösterilecek label'ı döndürür.
     * Dil opsiyoneldir, default 'en' (İngilizce)
     */
    public function label(string $locale = 'en'): string
    {
        // config dosyasından label değerlerini al
        $labels = config('availability_labels');

        // Eğer locale yoksa default value dön
        return $labels[$this->value][$locale] ?? $this->value;
    }

    /**
     * Enum'un Global olup olmadığını kontrol eder
     */
    public function isGlobal(): bool
    {
        return $this === self::Global;
    }
}
