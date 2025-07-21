<?php

use Luecano\NumeroALetras\NumeroALetras;

if (!function_exists('money_to_words')) {
    /**
     * Convierte un número a letras incluyendo la moneda.
     *
     * @param float  $amount   Importe
     * @param string $currency 'PEN' | 'USD'
     * @return string
     */
    function money_to_words(float $amount, string $currency = 'PEN'): string
    {
        // Instancia una sola vez (se puede cachear)
        $formatter = new NumeroALetras();

        // Decidimos moneda
        $currencyMap = [
            'PEN' => ['soles', 'sol'],
            'USD' => ['dólares', 'dólar'],
        ];

        [$plural, $singular] = $currencyMap[$currency] ?? ['', ''];

        // Convierte
        return $formatter->toMoney($amount, 2, $singular, $plural);
    }
}