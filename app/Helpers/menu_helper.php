<?php

if (!function_exists('set_active_menu')) {
  /**
   * Determina si un elemento del menú debe estar activo
   * 
   * @param string|array $segments Segmentos de URL o múltiples rutas (separadas por |)
   * @param string $type Tipo de elemento (parent, sub, link)
   * @return string Clases CSS correspondientes
   */
  function set_active_menu($segments, string $type = 'link'): string
  {
    $uri = service('uri');
    $currentSegments = $uri->getSegments();

    // Convertir $segments en un array de rutas posibles
    $possiblePaths = [];
    if (is_string($segments)) {
      // Permitir múltiples rutas separadas por |
      $paths = explode('|', $segments);
      foreach ($paths as $path) {
        $possiblePaths[] = explode('/', $path);
      }
    } elseif (is_array($segments)) {
      // Si es un array simple, convertirlo en multidimensional
      if (count($segments) > 0 && is_array($segments[0])) {
        $possiblePaths = $segments;
      } else {
        $possiblePaths[] = $segments;
      }
    }

    // Para LINKS: Coincidencia exacta con cualquier ruta
    if ($type === 'link') {
      foreach ($possiblePaths as $path) {
        // mismos segmentos y misma cantidad de segmentos
        if (
          count($currentSegments) === count($path)
          && array_slice($currentSegments, 0, count($path)) === $path
        ) {
          return 'active';
        }
      }
      return '';
    }

    // Para PADRES y SUBMENUS: Coincidencia parcial con cualquier ruta
    $match = false;
    foreach ($possiblePaths as $path) {
      $expected = array_slice($currentSegments, 0, count($path));
      if ($expected === $path) {
        $match = true;
        break;
      }
    }

    return $match ? ($type === 'parent' ? 'hover show' : 'show') : '';
  }
}
