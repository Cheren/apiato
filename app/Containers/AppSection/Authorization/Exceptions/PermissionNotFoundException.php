<?php

namespace App\Containers\AppSection\Authorization\Exceptions;

use App\Ship\Parents\Exceptions\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PermissionNotFoundException
 *
 * @package App\Containers\AppSection\Authorization\Exceptions
 */
class PermissionNotFoundException extends Exception
{
    protected $code = Response::HTTP_NOT_FOUND;
    protected $message = 'The requested Permission was not found.';
}
