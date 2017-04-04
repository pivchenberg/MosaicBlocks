<?php

namespace Pivchenberg\MosaicBlocks\Mosaic;

use Pivchenberg\MosaicBlocks\MosaicType\MosaicTypeInterface;

/**
 * Class MosaicElement
 * @package Pivchenberg\MosaicBlocks\Mosaic
 */
class MosaicElement
{
	/**
	 * @var integer
	 */
	private $id;

	/**
	 * @var MosaicTypeInterface
	 */
	private $type;

	/**
	 * @return MosaicTypeInterface
	 */
	public function getType()
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