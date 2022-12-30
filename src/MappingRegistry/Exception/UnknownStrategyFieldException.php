<?php

namespace DataMapper\MappingRegistry\Exception;

final class UnknownStrategyFieldException extends MappingRegistryException
{
    public function __construct($message = "", $code = 0, \Throwable $previous = null)
    {
        $message = sprintf('Strategy for field: %s not registered', $message);
        parent::__construct($message, $code, $previous);
    }
}