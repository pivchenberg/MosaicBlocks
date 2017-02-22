<?php

namespace Mosaic;

use Mosaic\MosaicType\MosaicTypeInterface;

/**
 * Created by PhpStorm.
 * User: pivchenberg
 * DateTime: 22.02.2017 15:01
 */
class MosaicElement
{
	/**
	 * @var MosaicTypeInterface
	 */
	private $type;

	/**
	 * @return MosaicTypeInterface
	 */
	public function getType(): MosaicTypeInterface
	{
		return $this->type;
	}

	/**
	 * @param MosaicTypeInterface $type
	 */
	public function setType(MosaicTypeInterface $type)
	{
		$this->type = $type;
	}
}