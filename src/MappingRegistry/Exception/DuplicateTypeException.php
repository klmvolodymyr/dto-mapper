<?php

namespace DataMapper\MappingRegistry\Exception;

final class DuplicateTypeException extends \BadMethodCallException
{
    public function __construct(string $message = "", int $code = 0, \Throwable $previous = null)
    {
        $message = sprintf('%s:  %s - already registered', DuplicateTypeException::class, $message);
        parent::__construct($message, $code, $previous);
    }
}