<?php
/**
 * Created by PhpStorm.
 * User: pivchenberg
 * DateTime: 22.02.2017 15:22
 */

namespace Mosaic\MosaicType;

use Mosaic\MosaicType\MosaicTypeInterface;

class MosaicTypeHalfHorizontalFullVertical implements MosaicTypeInterface
{
	public function getShortName()
	{
		return '<1/2h|1v>';
	}
}