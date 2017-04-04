<?php
/**
 * Created by PhpStorm.
 * User: pivchenberg
 * DateTime: 22.02.2017 18:18
 */

namespace Pivchenberg\MosaicBlocks\Strategy;

use Pivchenberg\MosaicBlocks\Mosaic\MosaicElement;

interface MosaicStrategyInterface
{
	/**
	 * @param MosaicElement[]|array $mosaicElements
	 * @return null|MosaicElement
	 */
	public function findElement(&$mosaicElements);
}