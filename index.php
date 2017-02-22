<?php
/**
 * Created by PhpStorm.
 * User: pivchenberg
 * DateTime: 22.02.2017 14:58
 */

use Mosaic\MosaicElement;
use Mosaic\MosaicType\MosaicTypeFullHorizontalFullVertical;
use Mosaic\MosaicType\MosaicTypeQuarterHorizontalFullVertical;
use Mosaic\MosaicType\MosaicTypeHalfHorizontalHalfVertical;
use Mosaic\MosaicType\MosaicTypeHalfHorizontalFullVertical;
use Mosaic\Mosaic;

spl_autoload_register(function ($className) {
	include 'src/' .$className . '.php';
});

$mosaicElement1 = new MosaicElement();
$mosaicElement1->setType(new MosaicTypeFullHorizontalFullVertical());


$mosaicElement2 = new MosaicElement();
$mosaicElement2->setType(new MosaicTypeQuarterHorizontalFullVertical());

$mosaicElement3 = new MosaicElement();
$mosaicElement3->setType(new MosaicTypeQuarterHorizontalFullVertical());

$mosaicElement4 = new MosaicElement();
$mosaicElement4->setType(new MosaicTypeHalfHorizontalHalfVertical());

$mosaicElement5 = new MosaicElement();
$mosaicElement5->setType(new MosaicTypeHalfHorizontalHalfVertical());

$mosaicElement6 = new MosaicElement();
$mosaicElement6->setType(new MosaicTypeHalfHorizontalHalfVertical());

$mosaicElement7 = new MosaicElement();
$mosaicElement7->setType(new MosaicTypeHalfHorizontalHalfVertical());

$mosaicElement8 = new MosaicElement();
$mosaicElement8->setType(new MosaicTypeHalfHorizontalFullVertical());
//$mosaicElement9 = new MosaicElement();
//$mosaicElement10 = new MosaicElement();

$mosaicElements = [];
for($i = 1; $i <= 7; $i++)
	$mosaicElements[] = ${"mosaicElement{$i}"};

//echo '<pre>';
//print_r($mosaicElements);
//echo '</pre>';
//dump($mosaicElements);
$mosaic = new Mosaic($mosaicElements);
$resultMosaic = $mosaic->create();
dump($resultMosaic, 'resultMosaic!!!');

//$row = new \mosaic\MosaicRow([$mosaicElement3, $mosaicElement2, $mosaicElement8]);
//dump($row->isRowCompleted());













function dump($ar, $title = '')
{

	echo '<pre style="background: black; color: tomato; font-size: 12px; min-height: 10px;">';
	if($title)
		echo '<h4 style=" color: #fff">' . $title .'</h4>';
	print_r($ar);
	echo '</pre>';
}