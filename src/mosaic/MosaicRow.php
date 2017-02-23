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
use Mosaic\MosaicType\MosaicTypeThreeQuarterHorizontalFullVertical;

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

	private $rowFilledCorrectly = false;

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
				MosaicTypeFullHorizontalFullVertical::class
			],
			[
				//половинка по горизонтали, целый по вертикали
				MosaicTypeHalfHorizontalFullVertical::class,
				//половинка по горизонтали, целый по вертикали
				MosaicTypeHalfHorizontalFullVertical::class
			],
			[
				//половинка по горизонтали, целый по вертикали
				MosaicTypeHalfHorizontalFullVertical::class,
				//половинка по горизонтали, половинка по вертикали
				MosaicTypeHalfHorizontalHalfVertical::class,
				//половинка по горизонтали, половинка по вертикали
				MosaicTypeHalfHorizontalHalfVertical::class
			],
			[
				//четверть по горизонтили, целый по вертикали
				MosaicTypeQuarterHorizontalFullVertical::class,
				//четверть по горизонтили, целый по вертикали
				MosaicTypeQuarterHorizontalFullVertical::class,
				//половинка по горизонтали, целый по вертикали
				MosaicTypeHalfHorizontalFullVertical::class,
			],
			[
				//четверть по горизонтили, целый по вертикали
				MosaicTypeQuarterHorizontalFullVertical::class,
				//четверть по горизонтили, целый по вертикали
				MosaicTypeQuarterHorizontalFullVertical::class,
				//половинка по горизонтали, половинка по вертикали
				MosaicTypeHalfHorizontalHalfVertical::class,
				//половинка по горизонтали, половинка по вертикали
				MosaicTypeHalfHorizontalHalfVertical::class
			],
			[
				//Три четверти по горизонтали, целый по вертикали
				MosaicTypeThreeQuarterHorizontalFullVertical::class,
				//четверть по горизонтили, целый по вертикали
				MosaicTypeQuarterHorizontalFullVertical::class,
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

	/**
	 * @return boolean
	 */
	public function isRowFilledCorrectly(): bool
	{
		return $this->rowFilledCorrectly;
	}

	/**
	 * @param boolean $rowFilledCorrectly
	 */
	public function setRowFilledCorrectly(bool $rowFilledCorrectly)
	{
		$this->rowFilledCorrectly = $rowFilledCorrectly;
	}

	public function prepareOutput()
	{
		$cutOutMosaicElements = [];
		foreach($this->mosaicElements as $meIndex => $mosaicElement)
		{
			if($mosaicElement->getType() instanceof MosaicTypeHalfHorizontalHalfVertical)
			{
				$cutOutMosaicElements[$meIndex] = $mosaicElement;
				unset($this->mosaicElements[$meIndex]);
			}
		}

		$writeIndex = null;
		foreach($cutOutMosaicElements as $cutOutIndex => $cutOutMosaicElement)
		{
			if($writeIndex === null)
				$writeIndex = $cutOutIndex;

			if(isset($this->mosaicElements[$writeIndex]) && count($this->mosaicElements[$writeIndex]) === 2)
				$writeIndex = $cutOutIndex;

			$this->mosaicElements[$writeIndex][] = $cutOutMosaicElement;
		}
		ksort($this->mosaicElements);
	}
}