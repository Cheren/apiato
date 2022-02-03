<?php

namespace App\Containers\AppSection\Authentication\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LoginFailedException
 *
 * @package App\Containers\AppSection\Authentication\Exceptions
 */
class LoginFailedException extends Exception
{
    protected $code = Response::HTTP_BAD_REQUEST;
    protected $message = 'An Exception happened during the Login Process.';
}
