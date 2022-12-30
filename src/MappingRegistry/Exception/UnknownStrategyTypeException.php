<?php

namespace DataMapper\MappingRegistry\Exception;

final class UnknownStrategyTypeException extends MappingRegistryException
{
    public function __construct(string $type, int $code = 0, \Throwable $previous = null)
    {
        $message = sprintf('Strategy type: %s not registered', $type);
        parent::__construct($message, $code, $previous);
    }
}