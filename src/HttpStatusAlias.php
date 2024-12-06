<?php
/**
 * (c) Joffrey Demetz <joffrey.demetz@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace JDZ\Utils;

use JDZ\Utils\HttpStatusCode;
use JDZ\Utils\HttpStatusText;

/**
 * Alias values for HTTP Status codes as registered by IANA
 *
 * @see https://www.iana.org/assignments/http-status-codes/http-status-codes.xhtml
 */
enum HttpStatusAlias: string
{
  // Informational 1xx
  case HTTP_100 = 'HTTP_CONTINUE';
  case HTTP_101 = 'HTTP_SWITCHING_PROTOCOLS';
  case HTTP_102 = 'HTTP_PROCESSING';
  case HTTP_103 = 'HTTP_EARLY_HINTS';

  // Successful 2xx
  case HTTP_200 = 'HTTP_OK';
  case HTTP_201 = 'HTTP_CREATED';
  case HTTP_202 = 'HTTP_ACCEPTED';
  case HTTP_203 = 'HTTP_NON_AUTHORITATIVE_INFORMATION';
  case HTTP_204 = 'HTTP_NO_CONTENT';
  case HTTP_205 = 'HTTP_RESET_CONTENT';
  case HTTP_206 = 'HTTP_PARTIAL_CONTENT';
  case HTTP_207 = 'HTTP_MULTI_STATUS';
  case HTTP_208 = 'HTTP_ALREADY_REPORTED';
  case HTTP_226 = 'HTTP_IM_USED';

  // Redirection 3xx
  case HTTP_300 = 'HTTP_MULTIPLE_CHOICES';
  case HTTP_301 = 'HTTP_MOVED_PERMANENTLY';
  case HTTP_302 = 'HTTP_FOUND';
  case HTTP_303 = 'HTTP_SEE_OTHER';
  case HTTP_304 = 'HTTP_NOT_MODIFIED';
  case HTTP_305 = 'HTTP_USE_PROXY';
  case HTTP_307 = 'HTTP_TEMPORARY_REDIRECT';
  case HTTP_308 = 'HTTP_PERMANENTLY_REDIRECT';

  // Client Error 4xx
  case HTTP_400 = 'HTTP_BAD_REQUEST';
  case HTTP_401 = 'HTTP_UNAUTHORIZED';
  case HTTP_402 = 'HTTP_PAYMENT_REQUIRED';
  case HTTP_403 = 'HTTP_FORBIDDEN';
  case HTTP_404 = 'HTTP_NOT_FOUND';
  case HTTP_405 = 'HTTP_METHOD_NOT_ALLOWED';
  case HTTP_406 = 'HTTP_NOT_ACCEPTABLE';
  case HTTP_407 = 'HTTP_PROXY_AUTHENTICATION_REQUIRED';
  case HTTP_408 = 'HTTP_REQUEST_TIMEOUT';
  case HTTP_409 = 'HTTP_CONFLICT';
  case HTTP_410 = 'HTTP_GONE';
  case HTTP_411 = 'HTTP_LENGTH_REQUIRED';
  case HTTP_412 = 'HTTP_PRECONDITION_FAILED';
  case HTTP_413 = 'HTTP_REQUEST_ENTITY_TOO_LARGE';
  case HTTP_414 = 'HTTP_REQUEST_URI_TOO_LONG';
  case HTTP_415 = 'HTTP_UNSUPPORTED_MEDIA_TYPE';
  case HTTP_416 = 'HTTP_REQUESTED_RANGE_NOT_SATISFIABLE';
  case HTTP_417 = 'HTTP_EXPECTATION_FAILED';
  case HTTP_418 = 'HTTP_I_AM_A_TEAPOT';
  case HTTP_421 = 'HTTP_MISDIRECTED_REQUEST';
  case HTTP_422 = 'HTTP_UNPROCESSABLE_ENTITY';
  case HTTP_423 = 'HTTP_LOCKED';
  case HTTP_424 = 'HTTP_FAILED_DEPENDENCY';
  case HTTP_425 = 'HTTP_TOO_EARLY';
  case HTTP_426 = 'HTTP_UPGRADE_REQUIRED';
  case HTTP_428 = 'HTTP_PRECONDITION_REQUIRED';
  case HTTP_429 = 'HTTP_TOO_MANY_REQUESTS';
  case HTTP_431 = 'HTTP_REQUEST_HEADER_FIELDS_TOO_LARGE';
  case HTTP_451 = 'HTTP_UNAVAILABLE_FOR_LEGAL_REASONS';

  // Server Error 5xx
  case HTTP_500 = 'HTTP_INTERNAL_SERVER_ERROR';
  case HTTP_501 = 'HTTP_NOT_IMPLEMENTED';
  case HTTP_502 = 'HTTP_BAD_GATEWAY';
  case HTTP_503 = 'HTTP_SERVICE_UNAVAILABLE';
  case HTTP_504 = 'HTTP_GATEWAY_TIMEOUT';
  case HTTP_505 = 'HTTP_VERSION_NOT_SUPPORTED';
  case HTTP_506 = 'HTTP_VARIANT_ALSO_NEGOTIATES_EXPERIMENTAL';
  case HTTP_507 = 'HTTP_INSUFFICIENT_STORAGE';
  case HTTP_508 = 'HTTP_LOOP_DETECTED';
  case HTTP_510 = 'HTTP_NOT_EXTENDED';
  case HTTP_511 = 'HTTP_NETWORK_AUTHENTICATION_REQUIRED';
  
  public static function fromName(string $name): static
  {
    $constName = static::class.'::'.$name;
    if ( !defined($constName) ){
      throw new \ValueError(static::class.'::'.$name.' not found');
    }
    return constant($constName);
  }
  
  public static function fromHttpStatusCode(HttpStatusCode $statusCode): static
  {
    return self::fromName($statusCode->name);
  }
  
  public static function fromHttpStatusText(HttpStatusText $statusText): static
  {
    return self::fromName($statusText->name);
  }
}