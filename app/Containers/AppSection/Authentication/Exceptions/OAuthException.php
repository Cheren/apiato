<?php

namespace App\Containers\AppSection\Authentication\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class OAuthException
 *
 * @package App\Containers\AppSection\Authentication\Exceptions
 */
class OAuthException extends Exception
{
    protected $code = Response::HTTP_INTERNAL_SERVER_ERROR;
    protected $message = 'OAuth 2.0 is not installed.';
}
