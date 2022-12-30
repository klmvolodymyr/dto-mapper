<?php

namespace DataMapper\Hydrator;

use DataMapper\Exception\InvalidArgumentException;

class ObjectHydrator extends AbstractHydrator
{
    /**
     * {@inheritDoc}
     */
    public function hydrate($source, $destination)
    {
        $this->validateTypes($source, $destination);
        $dto = \is_object($destination) ? $destination : new $destination();

        if (\is_object($source)) {
            $sourceContent = $this->extract($source);
        } else {
            $sourceContent = $source;
        }

        $sourceContent = \array_merge(\get_object_vars($dto), $sourceContent);

        foreach ($sourceContent as $sourceKey => $sourceValue) {
            $hydratedName = $this->hydrateName($sourceKey, $dto);

            if ($hydratedName !== $sourceKey) {
                unset($sourceContent[$sourceKey]);
            }

            $sourceContent[$hydratedName] = $this->hydrateValue($sourceKey, $sourceValue, $source);
        }

        return $this->hydrateToObject($sourceContent, $dto);
    }

    /**
     * {@inheritDoc}
     */
    protected function validateTypes($source, $destination): void
    {
        if (!\is_array($source) && !\is_object($source)) {
            throw new InvalidArgumentException('$source argument - must be object or array type');
        }

        if (\is_string($destination) && !\class_exists($destination)) {
            throw new InvalidArgumentException('$destination argument - must by exist class name or object type');
        }
    }
}