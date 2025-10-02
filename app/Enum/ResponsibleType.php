<?php

namespace App\Enum;

enum ResponsibleType: string
{
    case Seller = 'seller';
    case Buyer  = 'buyer';

    /**
     * Kullanıcıya gösterilecek label
     */
    public function label(string $locale = 'en'): string
    {
        $labels = [
            'seller' => [
                'en' => 'Seller',
                'tr' => 'Satıcı',
                'de' => 'Verkäufer',
                'ru' => 'Продавец',
                'zh-CN' => '卖方',
                'he' => 'מוכר',
                'ar' => 'البائع',
                'az' => 'Satıcı'
            ],
            'buyer' => [
                'en' => 'Buyer',
                'tr' => 'Alıcı',
                'de' => 'Käufer',
                'ru' => 'Покупатель',
                'zh-CN' => '买方',
                'he' => 'קונה',
                'ar' => 'المشتري',
                'az' => 'Alıcı'
            ]
        ];

        return $labels[$this->value][$locale] ?? $this->value;
    }

    public function isSeller(): bool
    {
        return $this === self::Seller;
    }

    public function isBuyer(): bool
    {
        return $this === self::Buyer;
    }
}
