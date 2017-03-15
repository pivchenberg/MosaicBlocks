<?php
/**
 * Created by PhpStorm.
 * User: pivchenberg
 * DateTime: 22.02.2017 15:22
 */

namespace Mosaic\MosaicType;

use Mosaic\MosaicType\MosaicTypeInterface;

class MosaicTypeThreeQuarterHorizontalFullVertical implements MosaicTypeInterface
{
	public function getShortName()
	{
		return '<3/4h|1v>';
	}
}