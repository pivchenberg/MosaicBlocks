<?php
/**
 * Created by PhpStorm.
 * User: pivchenberg
 * DateTime: 22.02.2017 18:01
 */

namespace Mosaic\Strategy;

use Mosaic\MosaicRow;

class MosaicStrategyContext
{
	/**
	 * @var MosaicRow
	 */
	private $mosaicRow;

	/**
	 * @var MosaicStrategyInterface
	 */
	private $strategy;

	public function __construct(MosaicRow $mosaicRow)
	{
		$this->mosaicRow = $mosaicRow;
		$rowType = $this->mosaicRow->getRowType();

		dump($rowType);
		die();

		//Поиск стратегии
		switch($this->mosaicRow->getRowType())
		{
			case '<1/4>|1v':

			break;
		}
	}

	public function findElement(&$mosaicElements)
	{
		return $this->strategy->findElement($mosaicElements);
	}
}