<?php

namespace Pivchenberg\MosaicBlocks\Mosaic;

use Pivchenberg\MosaicBlocks\MosaicType\MosaicTypeInterface;

/**
 * Interface MosaicElementInterface
 * @package Pivchenberg\MosaicBlocks\Mosaic\
 */
interface MosaicElementInterface
{
    /**
     * @return MosaicTypeInterface
     */
    public function getMosaicType();
}