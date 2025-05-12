<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Jwt extends BaseConfig
{
  /**
   * Clave secreta para firmar los tokens
   */
  public string $secretKey = '';

  /**
   * Algoritmo de encriptación (HS256, RS256, etc)
   */
  public string $algorithm = 'HS256';

  /**
   * Tiempo de expiración en segundos (2 días = 172800)
   */
  public int $expiration = 172800;

  /**
   * Emisor del token
   */
  public string $issuer = 'http://tu-dominio.com';

  /**
   * Audiencia del token
   */
  public string $audience = 'http://tu-dominio.com';

  public function __construct()
  {
    parent::__construct();

    // Cargar clave secreta desde .env
    $this->secretKey = getenv('JWT_SECRET_KEY') ?: $this->secretKey;
  }
}
