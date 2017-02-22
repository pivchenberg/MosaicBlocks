<?php
/**
 * Created by PhpStorm.
 * User: pivchenberg
 * DateTime: 22.02.2017 18:18
 */

namespace mosaic\strategy;

use Mosaic\MosaicElement;

interface MosaicStrategyInterface
{
	/**
	 * @param MosaicElement[] $mosaicElements
	 * @return mixed
	 */
	public function findElement($mosaicElements);
}