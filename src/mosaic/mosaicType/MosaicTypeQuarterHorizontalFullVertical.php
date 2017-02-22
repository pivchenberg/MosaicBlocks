<?php

namespace Mosaic\MosaicType;

use Mosaic\MosaicType\MosaicTypeInterface;

/**
 * Created by PhpStorm.
 * User: pivchenberg
 * DateTime: 22.02.2017 15:22
 */
class MosaicTypeQuarterHorizontalFullVertical implements MosaicTypeInterface
{
	public function getShortName()
	{
		return '<1/4h|1v>';
	}
}