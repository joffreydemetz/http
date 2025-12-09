<?php

/**
 * @author    Joffrey Demetz <joffrey.demetz@gmail.com>
 * @license   MIT License; <https://opensource.org/licenses/MIT>
 */

namespace JDZ\Utils;

use JDZ\Utils\HttpStatusAlias;
use JDZ\Utils\HttpStatusText;

/**
 * Numeric values for HTTP Status codes as registered by IANA
 *
 * @see https://www.iana.org/assignments/http-status-codes/http-status-codes.xhtml
 */
enum HttpStatusCode: int
{
  // Informational 1xx
  case HTTP_100 = 100;
  case HTTP_101 = 101;
  case HTTP_102 = 102;
  case HTTP_103 = 103;

    // Successful 2xx
  case HTTP_200 = 200;
  case HTTP_201 = 201;
  case HTTP_202 = 202;
  case HTTP_203 = 203;
  case HTTP_204 = 204;
  case HTTP_205 = 205;
  case HTTP_206 = 206;
  case HTTP_207 = 207;
  case HTTP_208 = 208;
  case HTTP_226 = 226;

    // Redirection 3xx
  case HTTP_300 = 300;
  case HTTP_301 = 301;
  case HTTP_302 = 302;
  case HTTP_303 = 303;
  case HTTP_304 = 304;
  case HTTP_305 = 305;
  case HTTP_307 = 307;
  case HTTP_308 = 308;

    // Client Error 4xx
  case HTTP_400 = 400;
  case HTTP_401 = 401;
  case HTTP_402 = 402;
  case HTTP_403 = 403;
  case HTTP_404 = 404;
  case HTTP_405 = 405;
  case HTTP_406 = 406;
  case HTTP_407 = 407;
  case HTTP_408 = 408;
  case HTTP_409 = 409;
  case HTTP_410 = 410;
  case HTTP_411 = 411;
  case HTTP_412 = 412;
  case HTTP_413 = 413;
  case HTTP_414 = 414;
  case HTTP_415 = 415;
  case HTTP_416 = 416;
  case HTTP_417 = 417;
  case HTTP_421 = 421;
  case HTTP_422 = 422;
  case HTTP_423 = 423;
  case HTTP_424 = 424;
  case HTTP_425 = 425;
  case HTTP_426 = 426;
  case HTTP_428 = 428;
  case HTTP_429 = 429;
  case HTTP_431 = 431;
  case HTTP_451 = 451;

    // Server Error 5xx
  case HTTP_500 = 500;
  case HTTP_501 = 501;
  case HTTP_502 = 502;
  case HTTP_503 = 503;
  case HTTP_504 = 504;
  case HTTP_505 = 505;
  case HTTP_506 = 506;
  case HTTP_507 = 507;
  case HTTP_508 = 508;
  case HTTP_510 = 510;
  case HTTP_511 = 511;

  public static function fromName(string $name): static
  {
    $constName = static::class . '::' . $name;
    if (!defined($constName)) {
      throw new \ValueError(static::class . '::' . $name . ' not found');
    }
    return constant($constName);
  }

  public static function fromHttpStatusText(HttpStatusText $statusText): static
  {
    return self::fromName($statusText->name);
  }

  public static function fromHttpStatusAlias(HttpStatusAlias $statusAlias): static
  {
    return self::fromName($statusAlias->name);
  }
}
