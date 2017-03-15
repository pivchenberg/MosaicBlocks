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
		if(empty($mosaicElements))
			throw new \InvalidArgumentException('Mosaic elements list can not be empty');

		$this->mosaicElements = $mosaicElements;
		$this->create();
	}

	protected function create()
	{
		if(empty($this->currentRow))
		{
			//cut the first element
			$firstMosaicElement = array_shift($this->mosaicElements);
			$this->currentRow = new MosaicRow([$firstMosaicElement]);
		}

		if(!$this->currentRow->isRowCompleted())
		{
			//Поиск стратегии
			$strategyContext = new MosaicStrategyContext($this->currentRow);
			$detectedElement = $strategyContext->findMosaicElement($this->mosaicElements);
			if(!empty($detectedElement))
			{
				$this->currentRow->addMosaicElement($detectedElement);
			}
			else //Не получилось ничего найти, оставляем строку как есть
			{
				$this->currentRow->setRowFilledCorrectly(false);
				//Пишем в результат
				$this->resultMosaic[] = $this->currentRow;
				//Обнуляем текущую строчку
				$this->currentRow = null;
			}
		}
		else //Строчка заполнена
		{
			$this->currentRow->setRowFilledCorrectly(true);
			//Пишем в результат
			$this->resultMosaic[] = $this->currentRow;
			//Обнуляем текущую строчку
			$this->currentRow = null;
		}

		//recursive call
		if(!empty($this->mosaicElements))
			$this->create();
		elseif(!empty($this->currentRow)) //final row
		{
			$this->currentRow->setRowFilledCorrectly($this->currentRow->isRowCompleted());
			//Пишем в результат
			$this->resultMosaic[] = $this->currentRow;
			//Обнуляем текущую строчку
			$this->currentRow = null;
		}
	}

	/**
	 * @return MosaicRow[]
	 */
	public function getResultMosaic(): array
	{
		return $this->resultMosaic;
	}

	public function prepareOutput()
	{
		$cutOutRows = [];
		foreach($this->resultMosaic as $rowIndex => $mosaicRow)
		{
			$mosaicRow->prepareOutput();
			//Перемещаем вниз незаполненные строки
			if(!$mosaicRow->isRowFilledCorrectly())
			{
				$cutOutRows[] = $mosaicRow;
				unset($this->resultMosaic[$rowIndex]);
			}
		}

		foreach($cutOutRows as $cutOutRow)
		{
			$this->resultMosaic[] = $cutOutRow;
		}
	}
}