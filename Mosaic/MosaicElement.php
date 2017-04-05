<?php

namespace Pivchenberg\MosaicBlocks\Mosaic;

use Pivchenberg\MosaicBlocks\MosaicType\MosaicTypeInterface;

/**
 * Class MosaicElement
 * @package Pivchenberg\MosaicBlocks\Mosaic
 */
class MosaicElement implements MosaicElementInterface
{
	/**
	 * @var integer
	 */
	private $id;

	/**
	 * @var MosaicTypeInterface
	 */
	private $mosaicType;

    public function __construct(MosaicTypeInterface $mosaicType)
    {
        $this->mosaicType = $mosaicType;
    }

    /**
	 * @return MosaicTypeInterface
	 */
	public function getMosaicType()
	{
		return $this->mosaicType;
	}

	/**
	 * @param MosaicTypeInterface $mosaicType
	 */
	public function setMosaicType(MosaicTypeInterface $mosaicType)
	{
		$this->mosaicType = $mosaicType;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}
}