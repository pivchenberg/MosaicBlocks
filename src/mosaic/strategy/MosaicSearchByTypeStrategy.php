<?php
/**
 * Created by PhpStorm.
 * User: pivchenberg
 * DateTime: 22.02.2017 22:58
 */

namespace Mosaic\Strategy;

use Mosaic\MosaicElement;

class MosaicSearchByTypeStrategy implements MosaicStrategyInterface
{
	/**
	 * @var
	 */
	private $mosaicElementTypes;

	/**
	 * MosaicSearchStrategyByType constructor.
	 * @param string[] $mosaicElementTypes
	 */
	public function __construct(array $mosaicElementTypes)
	{
		$this->mosaicElementTypes = $mosaicElementTypes;
	}

	/**
	 * @param MosaicElement[] $mosaicElements
	 * @return MosaicElement|null
	 */
	public function findElement(&$mosaicElements)
	{
		return $this->findElementLoopingTypes($mosaicElements);
	}

	/**
	 * @param MosaicElement[] $mosaicElements
	 * @return MosaicElement|null
	 */
	public function findElementLoopingElements(&$mosaicElements)
	{
		if(empty($this->mosaicElementTypes))
			return null;

		//Берем первый тип
		$curMosaicTypeToSearch = array_shift($this->mosaicElementTypes);
		foreach($mosaicElements as $k => $mosaicElement)
		{
			if($mosaicElement->getType() instanceof $curMosaicTypeToSearch)
			{
				//Удаляем найденный элемент из списка
				unset($mosaicElements[$k]);
				//Возвращаем найденный элемент
				return $mosaicElement;
			}
		}

		//Если ничего не найдено, пробуем искать с другим типом
		return $this->findElementLoopingElements($mosaicElements);
	}

	/**
	 * @param MosaicElement[] $mosaicElements
	 * @return MosaicElement|null
	 */
	public function findElementLoopingTypes(&$mosaicElements)
	{
		if(empty($this->mosaicElementTypes))
			return null;

		foreach($mosaicElements as $k => $mosaicElement)
		{
			foreach($this->mosaicElementTypes as $mosaicElementType)
			{
				if($mosaicElement->getType() instanceof $mosaicElementType)
				{
					//Удаляем найденный элемент из списка
					unset($mosaicElements[$k]);
					//Возвращаем найденный элемент
					return $mosaicElement;
				}
			}
		}

		return null;
	}
}