<?php

namespace Pivchenberg\MosaicBlocks\Strategy;

use Pivchenberg\MosaicBlocks\Mosaic\MosaicElement;

/**
 * Class MosaicSearchByTypeStrategy
 * @package Pivchenberg\MosaicBlocks\Strategy
 */
class MosaicSearchByTypeStrategy implements MosaicStrategyInterface
{
    /**
     * @var array|\string[]
     */
    private $mosaicElementTypes;

    /**
     * MosaicSearchStrategyByType constructor.
     * @param array|\string[] $mosaicElementTypes
     */
    public function __construct(array $mosaicElementTypes)
    {
        $this->mosaicElementTypes = $mosaicElementTypes;
    }

    /**
     * @param MosaicElement[] $mosaicElements
     * @return MosaicElement|null
     */
    public function findElement(&$mosaicElements)
    {
        return $this->findElementLoopingTypes($mosaicElements);
    }

    /**
     * Take first element and looping through the all types.
     * If nothing found, take the second element
     *
     * @param MosaicElement[] $mosaicElements
     * @return MosaicElement|null
     */
    public function findElementLoopingTypes(&$mosaicElements)
    {
        if (empty($this->mosaicElementTypes)) {
            return null;
        }

        foreach ($mosaicElements as $k => $mosaicElement) {
            foreach ($this->mosaicElementTypes as $mosaicElementType) {
                if ($mosaicElement->getType() instanceof $mosaicElementType) {
                    // Delete the found element from the list
                    unset($mosaicElements[$k]);
                    // Return the found element
                    return $mosaicElement;
                }
            }
        }

        return null;
    }

    /**
     * Take the first type and loop through the all mosaic elements.
     * If nothing found, take the second type etc.
     *
     * @param MosaicElement[] $mosaicElements
     * @return MosaicElement|null
     */
    public function findElementLoopingElements(&$mosaicElements)
    {
        if (empty($this->mosaicElementTypes)) {
            return null;
        }

        // Take the first type
        $curMosaicTypeToSearch = array_shift($this->mosaicElementTypes);
        foreach ($mosaicElements as $k => $mosaicElement) {
            if ($mosaicElement->getType() instanceof $curMosaicTypeToSearch) {
                // Delete the found element from the list
                unset($mosaicElements[$k]);
                // Return the found element
                return $mosaicElement;
            }
        }

        // If nothing is found, try searching with a different type
        return $this->findElementLoopingElements($mosaicElements);
    }
}