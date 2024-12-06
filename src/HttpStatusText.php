<?php
/**
 * (c) Joffrey Demetz <joffrey.demetz@gmail.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace JDZ\Utils;

use JDZ\Utils\HttpStatusCode;
use JDZ\Utils\HttpStatusAlias;

/**
 * Text values for HTTP Status codes as registered by IANA
 *
 * @see https://www.iana.org/assignments/http-status-codes/http-status-codes.xhtml
 */
enum HttpStatusText: string
{
  // Informational 1xx
  case HTTP_100 = 'Continue';
  case HTTP_101 = 'Switching Protocols';
  case HTTP_102 = 'Processing';
  case HTTP_103 = 'Early Hints';

  // Successful 2xx
  case HTTP_200 = 'OK';
  case HTTP_201 = 'Created';
  case HTTP_202 = 'Accepted';
  case HTTP_203 = 'Non-Authoritative Information';
  case HTTP_204 = 'No Content';
  case HTTP_205 = 'Reset Content';
  case HTTP_206 = 'Partial Content';
  case HTTP_207 = 'Multi-Status';
  case HTTP_208 = 'Already Reported';
  case HTTP_226 = 'IM Used';

  // Redirection 3xx
  case HTTP_300 = 'Multiple Choices';
  case HTTP_301 = 'Moved Permanently';
  case HTTP_302 = 'Found';
  case HTTP_303 = 'See Other';
  case HTTP_304 = 'Not Modified';
  case HTTP_305 = 'Use Proxy';
  case HTTP_307 = 'Temporary Redirect';
  case HTTP_308 = 'Permanent Redirect';

  // Client Error 4xx
  case HTTP_400 = 'Bad Request';
  case HTTP_401 = 'Unauthorized';
  case HTTP_402 = 'Payment Required';
  case HTTP_403 = 'Forbidden';
  case HTTP_404 = 'Not Found';
  case HTTP_405 = 'Method Not Allowed';
  case HTTP_406 = 'Not Acceptable';
  case HTTP_407 = 'Proxy Authentication Required';
  case HTTP_408 = 'Request Timeout';
  case HTTP_409 = 'Conflict';
  case HTTP_410 = 'Gone';
  case HTTP_411 = 'Length Required';
  case HTTP_412 = 'Precondition Failed';
  case HTTP_413 = 'Payload Too Large';
  case HTTP_414 = 'URI Too Long';
  case HTTP_415 = 'Unsupported Media Type';
  case HTTP_416 = 'Range Not Satisfiable';
  case HTTP_417 = 'Expectation Failed';
  case HTTP_421 = 'Misdirected Request';
  case HTTP_422 = 'Unprocessable Entity';
  case HTTP_423 = 'Locked';
  case HTTP_424 = 'Failed Dependency';
  case HTTP_425 = 'Too Early';
  case HTTP_426 = 'Upgrade Required';
  case HTTP_428 = 'Precondition Required';
  case HTTP_429 = 'Too Many Requests';
  case HTTP_431 = 'Request Header Fields Too Large';
  case HTTP_451 = 'Unavailable For Legal Reasons';

  // Server Error 5xx
  case HTTP_500 = 'Internal Server Error';
  case HTTP_501 = 'Not Implemented';
  case HTTP_502 = 'Bad Gateway';
  case HTTP_503 = 'Service Unavailable';
  case HTTP_504 = 'Gateway Timeout';
  case HTTP_505 = 'HTTP Version Not Supported';
  case HTTP_506 = 'Variant Also Negotiates';
  case HTTP_507 = 'Insufficient Storage';
  case HTTP_508 = 'Loop Detected';
  case HTTP_510 = 'Not Extended';
  case HTTP_511 = 'Network Authentication Required';
  
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
  
  public static function fromHttpStatusAlias(HttpStatusAlias $statusAlias): static
  {
    return self::fromName($statusAlias->name);
  }
}