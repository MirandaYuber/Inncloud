<?php
namespace Yuber\Kernel\Domain\Exceptions;

class BusinessLogicException extends \Exception
{

    protected $message= "Inconsistency in business rule.";
    protected $code= 422;

}
