<?php

if (!function_exists('moneda')) {
  /**
   * Formatea un número como moneda con separadores de miles y decimales
   * @param mixed $numero Número a formatear (entero, float o string numérico)
   * @param int $decimales Número de decimales (por defecto 2)
   * @param string $sep_decimal Separador decimal (por defecto '.')
   * @param string $sep_millar Separador de miles (por defecto ',')
   * @return string
   */
  function moneda($numero, $decimales = 2, $sep_decimal = '.', $sep_millar = ',')
  {
    // Convertir a float eliminando caracteres no numéricos (excepto punto)
    $numero_limpio = preg_replace('/[^0-9\.]/', '', (string)$numero);
    $numero_float = (float)$numero_limpio;

    return number_format($numero_float, $decimales, $sep_decimal, $sep_millar);
  }
}
