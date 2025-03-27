<?php

namespace ClientProduct\Domain\Exceptions;

class DuplicateKeyException extends \Exception
{
    protected $message = 'Ya existe un cliente con el mismo email.';
    protected $code = 404;
    protected $errors = [];
}
