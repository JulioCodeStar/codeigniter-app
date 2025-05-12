<?php

if (!function_exists('fecha_dmy')) {
  /**
   * Formatea una fecha a dd/mm/YYYY
   * @param string $fecha Fecha en cualquier formato válido
   * @return string
   */
  function fecha_dmy($fecha)
  {
    try {
      $date = new DateTime($fecha);
      return $date->format('d/m/Y');
    } catch (Exception $e) {
      return 'Fecha inválida';
    }
  }
}

if (!function_exists('fecha_spanish')) {
  /**
   * Formatea una fecha en español: Ej. 24, Abril del 2025
   * @param string $fecha Fecha en cualquier formato válido
   * @return string
   */
  function fecha_spanish($fecha)
  {
    try {
      $date = new DateTime($fecha);

      // Configura el formateador en español
      $formatter = new IntlDateFormatter(
        'es_ES',                // Idioma: español de España
        IntlDateFormatter::FULL, // Estilo completo (no necesario pero requerido)
        IntlDateFormatter::NONE,
        null,                    // Zona horaria (usar la predeterminada)
        null,                    // Calendar type (Gregoriano)
        "d 'de' MMMM 'del' Y"   // Patrón personalizado
      );

      // Capitalizar la primera letra del mes
      $fecha_formateada = $formatter->format($date);
      return ucfirst(mb_strtolower($fecha_formateada, 'UTF-8'));
    } catch (Exception $e) {
      return 'Fecha inválida';
    }
  }
}
