<?php

namespace Pivchenberg\MosaicBlocks\Mosaic;

use Pivchenberg\MosaicBlocks\Strategy\MosaicStrategyContext;

class Mosaic
{
    /**
     * Input array of mosaic elements
     * @var array|MosaicElementInterface[]
     */
    private $mosaicElements;

    /**
     * @var null|MosaicRow
     */
    private $currentRow = null;

    /**
     * @var MosaicRow[]
     */
    private $resultMosaic;

    /**
     * Mosaic constructor.
     * @param MosaicElementInterface[] $mosaicElements
     */
    public function __construct(array $mosaicElements)
    {
        if (empty($mosaicElements)) {
            throw new \InvalidArgumentException('Mosaic elements list can not be empty');
        }

        $this->mosaicElements = $mosaicElements;
        $this->create();
    }

    protected function create()
    {
        if (empty($this->currentRow)) {
            // Cut the first element
            $firstMosaicElement = array_shift($this->mosaicElements);
            $this->currentRow = new MosaicRow([$firstMosaicElement]);
        }

        if (!$this->currentRow->isRowCompleted()) {
            // Determine strategy
            $strategyContext = new MosaicStrategyContext($this->currentRow);
            $detectedElement = $strategyContext->findMosaicElement($this->mosaicElements);
            if (!empty($detectedElement)) {
                $this->currentRow->addMosaicElement($detectedElement);
            } else {
                // There was nothing to find, leave the line as is
                $this->currentRow->setRowFilledCorrectly(false);
                // Write in the result
                $this->resultMosaic[] = $this->currentRow;
                // Set to null current row and go to the next line
                $this->currentRow = null;
            }
        } else {
            // Row is completed
            $this->currentRow->setRowFilledCorrectly(true);
            // Write in the result
            $this->resultMosaic[] = $this->currentRow;
            // Set to null current row and go to the next line
            $this->currentRow = null;
        }

        // Recursive call
        if (!empty($this->mosaicElements)) {
            $this->create();
        } elseif (!empty($this->currentRow)) {
            // Final row
            $this->currentRow->setRowFilledCorrectly($this->currentRow->isRowCompleted());
            // Write in the result
            $this->resultMosaic[] = $this->currentRow;
            // Set to null current row
            $this->currentRow = null;
        }
    }

    /**
     * @return MosaicRow[]
     */
    public function getResultMosaic(): array
    {
        return $this->resultMosaic;
    }

    public function prepareOutput()
    {
        $cutOutRows = [];
        foreach ($this->resultMosaic as $rowIndex => $mosaicRow) {
            $mosaicRow->prepareOutput();
            // Move down unfilled rows
            if (!$mosaicRow->isRowFilledCorrectly()) {
                $cutOutRows[] = $mosaicRow;
                unset($this->resultMosaic[$rowIndex]);
            }
        }

        foreach ($cutOutRows as $cutOutRow) {
            $this->resultMosaic[] = $cutOutRow;
        }
    }
}