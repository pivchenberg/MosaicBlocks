<?php
/**
 * Created by PhpStorm.
 * User: pivchenberg
 * DateTime: 22.02.2017 16:12
 */

namespace mosaic;


use Mosaic\MosaicType\MosaicTypeFullHorizontalFullVertical;
use Mosaic\MosaicType\MosaicTypeHalfHorizontalFullVertical;
use Mosaic\MosaicType\MosaicTypeHalfHorizontalHalfVertical;
use Mosaic\MosaicType\MosaicTypeQuarterHorizontalFullVertical;

class MosaicRow
{
	/**
	 * @var array|MosaicElement[]
	 */
	private $mosaicElements;

	/**
	 * Критерии завершенности строки
	 * Порядок элементов не имеет значения
	 *
	 * @var MosaicElement[]
	 */
	private $rowCompletedCriteria;

	/**
	 * Mosaic constructor.
	 * @param MosaicElement[] $mosaicElements
	 */
	public function __construct(array $mosaicElements)
	{
		$this->mosaicElements = $mosaicElements;

		//Критерии завершенности строки
		$this->rowCompletedCriteria = [
			[
				//целый по горизонтали, целый по вертикали
				new MosaicTypeFullHorizontalFullVertical()
			],
			[
				//половинка по горизонтали, целый по вертикали
				new MosaicTypeHalfHorizontalFullVertical(),
				//половинка по горизонтали, половинка по вертикали
				new MosaicTypeHalfHorizontalHalfVertical(),
				//половинка по горизонтали, половинка по вертикали
				new MosaicTypeHalfHorizontalHalfVertical()
			],
			[
				//четверть по вертикали, целый по горизонтали
				new MosaicTypeQuarterHorizontalFullVertical(),
				//четверть по вертикали, целый по горизонтали
				new MosaicTypeQuarterHorizontalFullVertical(),
				//половинка по горизонтали, целый по вертикали
				new MosaicTypeHalfHorizontalFullVertical(),
			]
		];
	}

	/**
	 * Метод проверки заполнена ли строка
	 *
	 * @return boolean
	 */
	public function isRowCompleted():bool
	{
		$mosaicElementFoundInCriteria = false;

		//Поиск по всем критериям завершенности
		foreach ($this->rowCompletedCriteria as $rowCompletedCriteria)
		{
			//Все элементы текущей строки
			foreach($this->mosaicElements as $mosaicElement)
			{
				$mosaicElementFoundInCriteria = false;

				foreach($rowCompletedCriteria as $k => $mosaicTypeCriteria)
				{
					if($mosaicElement->getType() instanceof $mosaicTypeCriteria)
					{
						$mosaicElementFoundInCriteria = true;
						unset($rowCompletedCriteria[$k]);
						break;
					}
				}

				if(!$mosaicElementFoundInCriteria)
					continue 2;
			}

			return empty($rowCompletedCriteria);
		}

		return $mosaicElementFoundInCriteria;
	}

	public function addMosaicElement(MosaicElement $mosaicElement)
	{
		$this->mosaicElements[] = $mosaicElement;
	}

	public function getMosaicElements()
	{
		return $this->mosaicElements;
	}

	/**
	 * Тип строки (текущего состояния) для поиска стратегии
	 *
	 * @return string
	 */
	public function getRowType()
	{
		$arId = [];
		foreach($this->mosaicElements as $mosaicElement)
		{
			$arId[] = $mosaicElement->getType()->getShortName();
		}

		return implode(' ', $arId);
	}
}