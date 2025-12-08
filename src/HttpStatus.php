<?php

/**
 * @author    Joffrey Demetz <joffrey.demetz@gmail.com>
 * @license   MIT License; <https://opensource.org/licenses/MIT>
 */

namespace JDZ\Utils;

/**
 * HTTP Statuses as registered by IANA
 *
 * @see https://www.iana.org/assignments/http-status-codes/http-status-codes.xhtml
 */
enum HttpStatus: int
{
  // Informational 1xx
  case HTTP_100 = 100;
  case HTTP_101 = 101;
  case HTTP_102 = 102;
  case HTTP_103 = 103;
  case HTTP_104 = 104;

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

  public static function fromAlias(string $alias): static
  {
    foreach (self::cases() as $case) {
      if ($case->getAlias() === $alias) {
        return $case;
      }
    }
    return self::fromName($alias);
  }

  public function getText(): string
  {
    return match ($this) {
      self::HTTP_100 => 'Continue',
      self::HTTP_101 => 'Switching Protocols',
      self::HTTP_102 => 'Processing',
      self::HTTP_103 => 'Early Hints',
      self::HTTP_104 => 'Upload Resumption Supported (TEMPORARY)',
      self::HTTP_200 => 'OK',
      self::HTTP_201 => 'Created',
      self::HTTP_202 => 'Accepted',
      self::HTTP_203 => 'Non-Authoritative Information',
      self::HTTP_204 => 'No Content',
      self::HTTP_205 => 'Reset Content',
      self::HTTP_206 => 'Partial Content',
      self::HTTP_207 => 'Multi-Status',
      self::HTTP_208 => 'Already Reported',
      self::HTTP_226 => 'IM Used',
      self::HTTP_300 => 'Multiple Choices',
      self::HTTP_301 => 'Moved Permanently',
      self::HTTP_302 => 'Found',
      self::HTTP_303 => 'See Other',
      self::HTTP_304 => 'Not Modified',
      self::HTTP_305 => 'Use Proxy',
      self::HTTP_307 => 'Temporary Redirect',
      self::HTTP_308 => 'Permanent Redirect',
      self::HTTP_400 => 'Bad Request',
      self::HTTP_401 => 'Unauthorized',
      self::HTTP_402 => 'Payment Required',
      self::HTTP_403 => 'Forbidden',
      self::HTTP_404 => 'Not Found',
      self::HTTP_405 => 'Method Not Allowed',
      self::HTTP_406 => 'Not Acceptable',
      self::HTTP_407 => 'Proxy Authentication Required',
      self::HTTP_408 => 'Request Timeout',
      self::HTTP_409 => 'Conflict',
      self::HTTP_410 => 'Gone',
      self::HTTP_411 => 'Length Required',
      self::HTTP_412 => 'Precondition Failed',
      self::HTTP_413 => 'Payload Too Large',
      self::HTTP_414 => 'URI Too Long',
      self::HTTP_415 => 'Unsupported Media Type',
      self::HTTP_416 => 'Range Not Satisfiable',
      self::HTTP_417 => 'Expectation Failed',
      self::HTTP_421 => 'Misdirected Request',
      self::HTTP_422 => 'Unprocessable Entity',
      self::HTTP_423 => 'Locked',
      self::HTTP_424 => 'Failed Dependency',
      self::HTTP_425 => 'Too Early',
      self::HTTP_426 => 'Upgrade Required',
      self::HTTP_428 => 'Precondition Required',
      self::HTTP_429 => 'Too Many Requests',
      self::HTTP_431 => 'Request Header Fields Too Large',
      self::HTTP_451 => 'Unavailable For Legal Reasons',
      self::HTTP_500 => 'Internal Server Error',
      self::HTTP_501 => 'Not Implemented',
      self::HTTP_502 => 'Bad Gateway',
      self::HTTP_503 => 'Service Unavailable',
      self::HTTP_504 => 'Gateway Timeout',
      self::HTTP_505 => 'HTTP Version Not Supported',
      self::HTTP_506 => 'Variant Also Negotiates',
      self::HTTP_507 => 'Insufficient Storage',
      self::HTTP_508 => 'Loop Detected',
      self::HTTP_510 => 'Not Extended (OBSOLETE)',
      self::HTTP_511 => 'Network Authentication Required',
    };
  }

  public function getAlias(): string
  {
    return match ($this) {
      self::HTTP_100 => 'HTTP_CONTINUE',
      self::HTTP_101 => 'HTTP_SWITCHING_PROTOCOLS',
      self::HTTP_102 => 'HTTP_PROCESSING',
      self::HTTP_103 => 'HTTP_EARLY_HINTS',
      self::HTTP_104 => 'HTTP_UPLOAD_RESUMPTION_SUPPORTED',
      self::HTTP_200 => 'HTTP_OK',
      self::HTTP_201 => 'HTTP_CREATED',
      self::HTTP_202 => 'HTTP_ACCEPTED',
      self::HTTP_203 => 'HTTP_NON_AUTHORITATIVE_INFORMATION',
      self::HTTP_204 => 'HTTP_NO_CONTENT',
      self::HTTP_205 => 'HTTP_RESET_CONTENT',
      self::HTTP_206 => 'HTTP_PARTIAL_CONTENT',
      self::HTTP_207 => 'HTTP_MULTI_STATUS',
      self::HTTP_208 => 'HTTP_ALREADY_REPORTED',
      self::HTTP_226 => 'HTTP_IM_USED',
      self::HTTP_300 => 'HTTP_MULTIPLE_CHOICES',
      self::HTTP_301 => 'HTTP_MOVED_PERMANENTLY',
      self::HTTP_302 => 'HTTP_FOUND',
      self::HTTP_303 => 'HTTP_SEE_OTHER',
      self::HTTP_304 => 'HTTP_NOT_MODIFIED',
      self::HTTP_305 => 'HTTP_USE_PROXY',
      self::HTTP_307 => 'HTTP_TEMPORARY_REDIRECT',
      self::HTTP_308 => 'HTTP_PERMANENTLY_REDIRECT',
      self::HTTP_400 => 'HTTP_BAD_REQUEST',
      self::HTTP_401 => 'HTTP_UNAUTHORIZED',
      self::HTTP_402 => 'HTTP_PAYMENT_REQUIRED',
      self::HTTP_403 => 'HTTP_FORBIDDEN',
      self::HTTP_404 => 'HTTP_NOT_FOUND',
      self::HTTP_405 => 'HTTP_METHOD_NOT_ALLOWED',
      self::HTTP_406 => 'HTTP_NOT_ACCEPTABLE',
      self::HTTP_407 => 'HTTP_PROXY_AUTHENTICATION_REQUIRED',
      self::HTTP_408 => 'HTTP_REQUEST_TIMEOUT',
      self::HTTP_409 => 'HTTP_CONFLICT',
      self::HTTP_410 => 'HTTP_GONE',
      self::HTTP_411 => 'HTTP_LENGTH_REQUIRED',
      self::HTTP_412 => 'HTTP_PRECONDITION_FAILED',
      self::HTTP_413 => 'HTTP_REQUEST_ENTITY_TOO_LARGE',
      self::HTTP_414 => 'HTTP_REQUEST_URI_TOO_LONG',
      self::HTTP_415 => 'HTTP_UNSUPPORTED_MEDIA_TYPE',
      self::HTTP_416 => 'HTTP_REQUESTED_RANGE_NOT_SATISFIABLE',
      self::HTTP_417 => 'HTTP_EXPECTATION_FAILED',
      self::HTTP_421 => 'HTTP_MISDIRECTED_REQUEST',
      self::HTTP_422 => 'HTTP_UNPROCESSABLE_ENTITY',
      self::HTTP_423 => 'HTTP_LOCKED',
      self::HTTP_424 => 'HTTP_FAILED_DEPENDENCY',
      self::HTTP_425 => 'HTTP_TOO_EARLY',
      self::HTTP_426 => 'HTTP_UPGRADE_REQUIRED',
      self::HTTP_428 => 'HTTP_PRECONDITION_REQUIRED',
      self::HTTP_429 => 'HTTP_TOO_MANY_REQUESTS',
      self::HTTP_431 => 'HTTP_REQUEST_HEADER_FIELDS_TOO_LARGE',
      self::HTTP_451 => 'HTTP_UNAVAILABLE_FOR_LEGAL_REASONS',
      self::HTTP_500 => 'HTTP_INTERNAL_SERVER_ERROR',
      self::HTTP_501 => 'HTTP_NOT_IMPLEMENTED',
      self::HTTP_502 => 'HTTP_BAD_GATEWAY',
      self::HTTP_503 => 'HTTP_SERVICE_UNAVAILABLE',
      self::HTTP_504 => 'HTTP_GATEWAY_TIMEOUT',
      self::HTTP_505 => 'HTTP_VERSION_NOT_SUPPORTED',
      self::HTTP_506 => 'HTTP_VARIANT_ALSO_NEGOTIATES',
      self::HTTP_507 => 'HTTP_INSUFFICIENT_STORAGE',
      self::HTTP_508 => 'HTTP_LOOP_DETECTED',
      self::HTTP_510 => 'HTTP_NOT_EXTENDED',
      self::HTTP_511 => 'HTTP_NETWORK_AUTHENTICATION_REQUIRED',
    };
  }
}
