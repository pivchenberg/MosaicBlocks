<?php
/**
 * Created by PhpStorm.
 * User: pivchenberg
 * DateTime: 22.02.2017 16:09
 */

namespace mosaic;

use Mosaic\MosaicElement;
use Mosaic\Strategy\MosaicStrategyContext;

class Mosaic
{
	/**
	 * Входной массив элементов мозаики
	 *
	 * @var array|MosaicElement[]
	 */
	private $mosaicElements;

	/**
	 * @var null|MosaicRow
	 */
	private $currentRow = null;

	/**
	 * @var MosaicRow[]
	 */
	private $resultMosaic;

	/**
	 * Mosaic constructor.
	 * @param MosaicElement[] $mosaicElements
	 */
	public function __construct(array $mosaicElements)
	{
		$this->mosaicElements = $mosaicElements;
	}

	/**
	 * @return MosaicRow[]
	 */
	public function create()
	{
		if(empty($this->currentRow))
		{
			//grab the first element
			$firstMosaicElement = array_shift($this->mosaicElements);
			$this->currentRow = new MosaicRow([$firstMosaicElement]);
		}

		if(!$this->currentRow->isRowCompleted())
		{
			//Поиск стратегии
			$strategyContext = new MosaicStrategyContext($this->currentRow);

			$detectedElement = $strategyContext->findElement($this->mosaicElements);
		}
		else //Строчка заполнена
		{
			//Пишем в результат
			$this->resultMosaic[] = $this->currentRow;
			//Обнуляем текущую строчку
			$this->currentRow = null;
		}



		//recursive call
		if(!empty($this->mosaicElements))
			$this->create();

		return $this->resultMosaic;
	}

	/**
	 * @return MosaicRow[]
	 */
	public function getResultMosaic(): array
	{
		return $this->resultMosaic;
	}
}