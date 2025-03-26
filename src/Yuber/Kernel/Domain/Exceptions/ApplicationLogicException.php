<?php

namespace Yuber\Kernel\Domain\Exceptions;

class ApplicationLogicException extends \Exception
{

    protected $message= "Inconsistency in execution.";
    protected $code= 500;
}
