<?php

namespace Pivchenberg\MosaicBlocks\Strategy;

use Pivchenberg\MosaicBlocks\Mosaic\MosaicElement;
use Pivchenberg\MosaicBlocks\Mosaic\MosaicRow;
use Pivchenberg\MosaicBlocks\MosaicType\MosaicTypeHalfHorizontalFullVertical;
use Pivchenberg\MosaicBlocks\MosaicType\MosaicTypeHalfHorizontalHalfVertical;
use Pivchenberg\MosaicBlocks\MosaicType\MosaicTypeQuarterHorizontalFullVertical;
use Pivchenberg\MosaicBlocks\MosaicType\MosaicTypeThreeQuarterHorizontalFullVertical;

/**
 * Class MosaicStrategyContext
 * @package Pivchenberg\MosaicBlocks\Strategy
 */
class MosaicStrategyContext
{
	/**
	 * @var MosaicRow
	 */
	private $mosaicRow;

	/**
	 * @var MosaicStrategyInterface|null
	 */
	private $strategy = null;

	public function __construct(MosaicRow $mosaicRow)
	{
		$this->mosaicRow = $mosaicRow;
		$rowType = $this->mosaicRow->getRowType();

		// Strategy search
		switch($rowType)
		{
			/**==============
			1/4h|1v
			================**/
			/*
			 0000------------
			 0000------------
			 0000------------
			 0000------------
			 */
			case '<1/4h|1v>':
				$this->strategy = new MosaicSearchByTypeStrategy([
					MosaicTypeThreeQuarterHorizontalFullVertical::class,
					MosaicTypeQuarterHorizontalFullVertical::class
				]);
			break;
			/*
			 00000000--------
			 00000000--------
			 00000000--------
			 00000000--------
			 */
			case '<1/4h|1v> <1/4h|1v>':
				$this->strategy = new MosaicSearchByTypeStrategy([
					MosaicTypeHalfHorizontalFullVertical::class,
					MosaicTypeHalfHorizontalHalfVertical::class,
					MosaicTypeQuarterHorizontalFullVertical::class
				]);
			break;
			/*
			 000000000000----
			 000000000000----
			 000000000000----
			 000000000000----
			 */
			case '<1/4h|1v> <1/4h|1v> <1/4h|1v>':
				$this->strategy = new MosaicSearchByTypeStrategy([
					MosaicTypeQuarterHorizontalFullVertical::class
				]);
			break;
			/*
			 0000000000000000
			 0000000000000000
			 00000000--------
			 00000000--------
			 */
			case '<1/4h|1v> <1/4h|1v> <1/2h|1/2v>':
				$this->strategy = new MosaicSearchByTypeStrategy([
					MosaicTypeHalfHorizontalHalfVertical::class
				]);
			break;

			/**==============
			1/2h|1/2v
			================**/
			/*
			 00000000--------
			 00000000--------
			 ----------------
			 ----------------
			 */
			case '<1/2h|1/2v>':
				$this->strategy = new MosaicSearchByTypeStrategy([
					MosaicTypeHalfHorizontalHalfVertical::class
				]);
			break;
			/*
			 00000000--------
			 00000000--------
			 00000000--------
			 00000000--------
			 */
			case '<1/2h|1/2v> <1/2h|1/2v>':
				$this->strategy = new MosaicSearchByTypeStrategy([
					MosaicTypeHalfHorizontalFullVertical::class,
					MosaicTypeQuarterHorizontalFullVertical::class,
					MosaicTypeHalfHorizontalHalfVertical::class
				]);
			break;
			/*
			 000000000000----
			 000000000000----
			 000000000000----
			 000000000000----
			 */
			case '<1/2h|1/2v> <1/2h|1/2v> <1/4h|1v>':
				$this->strategy = new MosaicSearchByTypeStrategy([
					MosaicTypeQuarterHorizontalFullVertical::class,
				]);
			break;
			/*
			 0000000000000000
			 0000000000000000
			 00000000--------
			 00000000--------
			 */
			case '<1/2h|1/2v> <1/2h|1/2v> <1/2h|1/2v>':
				$this->strategy = new MosaicSearchByTypeStrategy([
					MosaicTypeHalfHorizontalHalfVertical::class
				]);
			break;

			/**==============
			1/2h|1v
			================**/
			/*
			 00000000--------
			 00000000--------
			 00000000--------
			 00000000--------
			 */
			case '<1/2h|1v>':
				$this->strategy = new MosaicSearchByTypeStrategy([
					MosaicTypeHalfHorizontalFullVertical::class,
					MosaicTypeHalfHorizontalHalfVertical::class,
					MosaicTypeQuarterHorizontalFullVertical::class
				]);
			break;
			/*
			 0000000000000000
			 0000000000000000
			 00000000--------
			 00000000--------
			 */
			case '<1/2h|1v> <1/2h|1/2v>':
				$this->strategy = new MosaicSearchByTypeStrategy([
					MosaicTypeHalfHorizontalHalfVertical::class,
				]);
			break;
			/*
			 000000000000----
			 000000000000----
			 000000000000----
			 000000000000----
			 */
			case '<1/2h|1v> <1/4h|1v>':
				$this->strategy = new MosaicSearchByTypeStrategy([
					MosaicTypeQuarterHorizontalFullVertical::class
				]);
			break;

			/**==============
			3/4h|1v
			================**/
			/*
			 000000000000----
			 000000000000----
			 000000000000----
			 000000000000----
			 */
			case '<3/4h|1v>':
				$this->strategy = new MosaicSearchByTypeStrategy([
					MosaicTypeQuarterHorizontalFullVertical::class
				]);
			break;
		}
	}

	/**
	 * @param MosaicElement[]|array $mosaicElements
	 * @return MosaicElement|null
	 */
	public function findMosaicElement(&$mosaicElements)
	{
		if($this->strategy === null)
			return null;

		return $this->strategy->findElement($mosaicElements);
	}
}