<?php

namespace DataMapper\Type;

final class TypeDict
{
    public const ALL_TYPE           = '*';
    public const STRATEGY_GLUE      = '#';
    public const HYDRATOR_GLUE      = ':';
    public const ARRAY_TO_OBJECT    = 'array:object';
    public const ARRAY_TO_CLASS     = 'array:class';
    public const OBJECT_TO_ARRAY    = 'object:array';
    public const ARRAY_TO_ARRAY     = 'array:array';
    public const OBJECT_TO_CLASS    = 'object:class';
    public const OBJECT_TO_OBJECT   = 'object:object';
    public const OBJECT_TYPE        = 'object';
    public const ARRAY_TYPE         = 'array';
    public const CLASS_TYPE         = 'class';
    public const STRING_TYPE        = 'string';
}
