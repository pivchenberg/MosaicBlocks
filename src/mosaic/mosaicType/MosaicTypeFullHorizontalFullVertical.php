<?php
/**
 * Created by PhpStorm.
 * User: pivchenberg
 * DateTime: 22.02.2017 15:22
 */

namespace Mosaic\MosaicType;

use Mosaic\MosaicType\MosaicTypeInterface;

class MosaicTypeFullHorizontalFullVertical implements MosaicTypeInterface
{
	public function getShortName()
	{
		return '<1h|1v>';
	}
}