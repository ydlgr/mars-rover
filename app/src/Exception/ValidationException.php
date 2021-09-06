<?php

namespace App\Exception;

use Exception;

class ValidationException extends Exception
{
    protected $code = 422;
}
