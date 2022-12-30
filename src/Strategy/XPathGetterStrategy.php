<?php

namespace DataMapper\Strategy;

use DataMapper\Exception\InvalidArgumentException;
use DataMapper\Strategy\Exception\EmptyXPathException;
use DataMapper\Hydrator\ExtractionInterface;

class XPathGetterStrategy implements StrategyInterface
{
    /**
     * @var ExtractionInterface
     */
    private $extractor;
    private const DELIMITER = '.';
    private array $xPathParts = [];

    public function __construct(ExtractionInterface $extractor, string $path, string $delimiter = self::DELIMITER)
    {
        if (!\substr_count($path, $delimiter)) {
            throw new EmptyXPathException($path);
        }

        $this->xPathParts = \explode($delimiter, $path);
        $this->extractor = $extractor;
    }

    /**
     * {@inheritDoc}
     */
    public function hydrate($value, $context)
    {
        [$sourceContext, $propertyName] = $context;

        if (!\is_object($sourceContext)) {
            throw new InvalidArgumentException('$value - argument must be object');
        }

        $extracted = $this->extractor->extract($sourceContext);

        foreach ($this->xPathParts as $step => $key) {

            if (!isset($extracted[$key])) {
                return null;
            }

            if (!\is_object($extracted[$key])) {
                $extracted = $extracted[$key];
            } else {
                $extracted = $this->extractor->extract($extracted[$key]);
            }
        }

        return $extracted;
    }
}