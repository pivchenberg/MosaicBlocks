<?php
/**
 * Created by PhpStorm.
 * User: pivchenberg
 * DateTime: 22.02.2017 16:12
 */

namespace Pivchenberg\MosaicBlocks\Mosaic;


use Pivchenberg\MosaicBlocks\MosaicType\MosaicTypeFullHorizontalFullVertical;
use Pivchenberg\MosaicBlocks\MosaicType\MosaicTypeHalfHorizontalFullVertical;
use Pivchenberg\MosaicBlocks\MosaicType\MosaicTypeHalfHorizontalHalfVertical;
use Pivchenberg\MosaicBlocks\MosaicType\MosaicTypeInterface;
use Pivchenberg\MosaicBlocks\MosaicType\MosaicTypeQuarterHorizontalFullVertical;
use Pivchenberg\MosaicBlocks\MosaicType\MosaicTypeThreeQuarterHorizontalFullVertical;

class MosaicRow
{
    /**
     * @var array|MosaicElementInterface[]
     */
    private $mosaicElements;

    /**
     * Row completeness criteria
     * The order of the elements does not matter
     *
     * @var MosaicTypeInterface[]
     */
    private $rowCompletedCriteria;

    private $rowFilledCorrectly = false;

    /**
     * Mosaic constructor.
     * @param MosaicElementInterface[] $mosaicElements
     */
    public function __construct(array $mosaicElements)
    {
        $this->mosaicElements = $mosaicElements;

        // Row completeness criteria
        $this->rowCompletedCriteria = [
            [
                MosaicTypeFullHorizontalFullVertical::class
            ],
            [
                MosaicTypeHalfHorizontalFullVertical::class,
                MosaicTypeHalfHorizontalFullVertical::class
            ],
            [
                MosaicTypeHalfHorizontalFullVertical::class,
                MosaicTypeHalfHorizontalHalfVertical::class,
                MosaicTypeHalfHorizontalHalfVertical::class
            ],
            [
                MosaicTypeQuarterHorizontalFullVertical::class,
                MosaicTypeQuarterHorizontalFullVertical::class,
                MosaicTypeHalfHorizontalFullVertical::class,
            ],
            [
                MosaicTypeQuarterHorizontalFullVertical::class,
                MosaicTypeQuarterHorizontalFullVertical::class,
                MosaicTypeHalfHorizontalHalfVertical::class,
                MosaicTypeHalfHorizontalHalfVertical::class
            ],
            [
                MosaicTypeThreeQuarterHorizontalFullVertical::class,
                MosaicTypeQuarterHorizontalFullVertical::class,
            ],
            [
                MosaicTypeHalfHorizontalHalfVertical::class,
                MosaicTypeHalfHorizontalHalfVertical::class,
                MosaicTypeHalfHorizontalHalfVertical::class,
                MosaicTypeHalfHorizontalHalfVertical::class,
            ],
            [
                MosaicTypeQuarterHorizontalFullVertical::class,
                MosaicTypeQuarterHorizontalFullVertical::class,
                MosaicTypeQuarterHorizontalFullVertical::class,
                MosaicTypeQuarterHorizontalFullVertical::class,
            ]
        ];
    }

    /**
     * Check if row completed
     *
     * @return boolean
     */
    public function isRowCompleted()
    {
        $mosaicElementFoundInCriteria = false;

        // Search by all criteria of completeness
        foreach ($this->rowCompletedCriteria as $rowCompletedCriteria) {
            // All elements of the current row
            foreach ($this->mosaicElements as $mosaicElement) {
                $mosaicElementFoundInCriteria = false;

                foreach ($rowCompletedCriteria as $k => $mosaicTypeCriteria) {
                    if ($mosaicElement->getMosaicType() instanceof $mosaicTypeCriteria) {
                        $mosaicElementFoundInCriteria = true;
                        unset($rowCompletedCriteria[$k]);
                        break;
                    }
                }

                if (!$mosaicElementFoundInCriteria) {
                    continue 2;
                }
            }

            return empty($rowCompletedCriteria);
        }

        return $mosaicElementFoundInCriteria;
    }

    public function addMosaicElement(MosaicElementInterface $mosaicElement)
    {
        $this->mosaicElements[] = $mosaicElement;
    }

    public function getMosaicElements()
    {
        return $this->mosaicElements;
    }

    /**
     * Type of row (current state) for strategy search
     *
     * @return string
     */
    public function getRowType()
    {
        $arId = [];
        foreach ($this->mosaicElements as $mosaicElement) {
            $arId[] = $mosaicElement->getMosaicType()->getShortName();
        }

        return implode(' ', $arId);
    }

    /**
     * @return boolean
     */
    public function isRowFilledCorrectly()
    {
        return $this->rowFilledCorrectly;
    }

    /**
     * @param boolean $rowFilledCorrectly
     */
    public function setRowFilledCorrectly($rowFilledCorrectly)
    {
        $this->rowFilledCorrectly = $rowFilledCorrectly;
    }

    public function prepareOutput()
    {
        $cutOutMosaicElements = [];
        foreach ($this->mosaicElements as $meIndex => $mosaicElement) {
            if ($mosaicElement->getMosaicType() instanceof MosaicTypeHalfHorizontalHalfVertical) {
                $cutOutMosaicElements[$meIndex] = $mosaicElement;
                unset($this->mosaicElements[$meIndex]);
            }
        }

        $writeIndex = null;
        foreach ($cutOutMosaicElements as $cutOutIndex => $cutOutMosaicElement) {
            if ($writeIndex === null) {
                $writeIndex = $cutOutIndex;
            }

            if (isset($this->mosaicElements[$writeIndex]) && count($this->mosaicElements[$writeIndex]) === 2) {
                $writeIndex = $cutOutIndex;
            }

            $this->mosaicElements[$writeIndex][] = $cutOutMosaicElement;
        }
        ksort($this->mosaicElements);
    }
}