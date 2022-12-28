<?php

namespace DataMapper\Hydrator;

use DataMapper\Exception\InvalidArgumentException;

class ArraySerializableHydrator extends AbstractHydrator
{
    /**
     * {@inheritDoc}
     */
    public function hydrate($source, $destination)
    {
        $this->validateTypes($source, $destination);

        foreach ($source as $name => $value) {
            $hydratedName = $this->hydrateName($name);

            if ($hydratedName !== $name) {
                unset($source[$name]);
            }

            $destination[$hydratedName] = $this->hydrateValue($name, $value, $destination);
        }

        return $destination;
    }

    /**
     * {@inheritDoc}
     */
    public function extract(object $type): array
    {
        $extracted = parent::extract($type);

        foreach ($extracted as $name => $value) {
            $extractedName = $this->extractName($name);

            if ($extractedName !== $name) {
                unset($extracted[$name]);
            }

            $extracted[$extractedName] = $value;
            if (\is_object($value)) {
                $extractedName[$extractedName] = parent::extract($value);
            }
        }

        return $extracted;
    }

    /**
     * {@inheritDoc}
     */
    protected function validateTypes($source, $destination): void
    {
        if (!\is_array($source) || !\is_array($destination)) {
            throw new InvalidArgumentException('$source and $destination arguments must be type array');
        }
    }
}