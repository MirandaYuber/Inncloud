<?php

namespace Innclod\OrderDetails\Domain\Exceptions;

class InsufficientStockException extends \Exception
{
    protected $message = 'No hay stock suficiente.';
    protected $code = 400;
    protected $errors = [];
}
