<?php

namespace DataMapper\Aggregation;

class ArrayAggregation
{
    /**
     * @var \Closure[]
     */
    private array $keys = [];

    /**
     * @var \Closure[]
     */
    private array $values = [];

    public function registerKeys(array $keys, \Closure $extractor): ArrayAggregation
    {
        $this->keys = [$keys, $extractor];

        return $this;
    }

    public function registerValues(array $keys, \Closure $extractor): ArrayAggregation
    {
        $this->values = [$keys, $extractor];

        return $this;
    }

    public function aggregate(array $raw, \Closure $reduce): array
    {
        $result = [];

        foreach ($this->map($raw) as $keys => $values) {
            $key = \implode("\x00", $keys);

            if (!\isset($result[$key])) {
                $result[$key] = [
                    'keys' => $keys,
                    'values' => $values,
                ];
                continue;
            }

            foreach ($values as $valueName => $value) {
                $result[$key]['values'][$valueName] = $reduce($result[$key]['values'][$valueName], $value);
            }
        }

        return $result;
    }

    private function map(array $raw): iterable
    {
        [$keys, $keyExtractor] = $this->keys;
        [$valuesKeys, $valueExtractor] = $this->values;

        foreach ($raw as $row) {
            yield \array_combine($keys, $keyExtractor($row)) =>\array_combine($valuesKeys, $valueExtractor($row));
        }
    }
}