<?php

namespace DataMapper\MappingRegistry\Exception;

final class UnknownHydratorTypeException extends \BadMethodCallException
{
    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        $message = sprintf('Hydrator type: %s not registered', $message);
        parent::__construct($message, $code, $previous);
    }
}