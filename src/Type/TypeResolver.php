<?php

namespace DataMapper\Type;

use DataMapper\Hydrator\ArrayCollectionHydrator;
use DataMapper\Hydrator\ArraySerializableHydrator;
use DataMapper\Hydrator\ObjectHydrator;

final class TypeResolver
{
    /**
     * @return array
     */
    public static function hydrationSupportedTypeSequence(): array
    {
        return [
            TypeDict::ARRAY_TO_OBJECT   => ArrayCollectionHydrator::class,
            TypeDict::ARRAY_TO_CLASS    => ArrayCollectionHydrator::class,
            TypeDict::OBJECT_TO_ARRAY   => ArraySerializableHydrator::class,
            TypeDict::ARRAY_TO_ARRAY    => ArraySerializableHydrator::class,
            TypeDict::OBJECT_TO_CLASS   => ObjectHydrator::class,
            TypeDict::OBJECT_TO_OBJECT  => ObjectHydrator::class,
        ];
    }

    /**
     * @param $variable
     *
     * @return string
     */
    public static function resolveStrategyType($variable): string
    {
        if (\is_object($variable)) {
            return \get_class($variable);
        }

        $type = self::resolveBaseType($variable);

        // If $variable is exists class name return class name
        return $type === TypeDict::CLASS_TYPE ? $variable : $type;
    }

    /**
     * @param mixed $source
     * @param mixed $destination
     *
     * @return string
     */
    public static function getStrategyType($source, $destination): string
    {
        return self::implodeType(
            self::resolveStrategyType($source),
            self::resolveStrategyType($destination),
            TypeDict::STRATEGY_GLUE
        );
    }

    /**
     * @param string $source
     * @param string $destination
     * @param string $glue
     *
     * @return string
     */
    public static function implodeType(string $source, string $destination, string $glue): string
    {
        return $source . $glue . $destination;
    }

    /**
     * @param mixed $source
     * @param mixed $destination
     *
     * @return string
     */
    public static function getHydratedType($source, $destination): string
    {
        return self::implodeType(
            self::resolveBaseType($source),
            self::resolveBaseType($destination),
            TypeDict::HYDRATOR_GLUE
        );
    }

    /**
     * @param mixed $variable
     *
     * @return string
     */
    public static function resolveBaseType($variable): string
    {
        $variableType = \gettype($variable);

        if ($variableType !== TypeDict::STRING_TYPE) {
            return $variableType;
        }

        switch ($variable) {
            case (TypeDict::ARRAY_TYPE):
                return TypeDict::ARRAY_TYPE;
            case (\class_exists($variable)):
                return TypeDict::CLASS_TYPE;
            case (TypeDict::ALL_TYPE):
                return TypeDict::ALL_TYPE;
            default:
                return $variableType;
        }
    }
}