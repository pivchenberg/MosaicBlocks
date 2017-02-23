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



//$mosaicElement1 = new MosaicElement();
//$mosaicElement1->setType(new MosaicTypeFullHorizontalFullVertical());
//
//$mosaicElement2 = new MosaicElement();
//$mosaicElement2->setType(new MosaicTypeQuarterHorizontalFullVertical());
//
//$mosaicElement3 = new MosaicElement();
//$mosaicElement3->setType(new MosaicTypeQuarterHorizontalFullVertical());
//
//$mosaicElement4 = new MosaicElement();
//$mosaicElement4->setType(new MosaicTypeHalfHorizontalHalfVertical());
//
//$mosaicElement5 = new MosaicElement();
//$mosaicElement5->setType(new MosaicTypeHalfHorizontalHalfVertical());
//
//$mosaicElement6 = new MosaicElement();
//$mosaicElement6->setType(new MosaicTypeHalfHorizontalHalfVertical());
//
//$mosaicElement7 = new MosaicElement();
//$mosaicElement7->setType(new MosaicTypeHalfHorizontalHalfVertical());
//
//$mosaicElement8 = new MosaicElement();
//$mosaicElement8->setType(new MosaicTypeHalfHorizontalFullVertical());

//$mosaicElements = [
//	$mosaicElement7,
//	$mosaicElement1,
//	$mosaicElement2,
//	$mosaicElement8,
//	$mosaicElement5,
//	$mosaicElement3,
//	$mosaicElement4,
//	$mosaicElement6,
//];


$randomElements = 30;
$mosaicElements = [];
$arMosaicTypes = [
	MosaicTypeFullHorizontalFullVertical::class,
	MosaicTypeHalfHorizontalFullVertical::class,
	MosaicTypeHalfHorizontalHalfVertical::class,
	MosaicTypeQuarterHorizontalFullVertical::class
];
for($i =0; $i < $randomElements; $i++){
    $typeClassIndex = array_rand($arMosaicTypes);
    $typeClass = $arMosaicTypes[$typeClassIndex];
    $me = new MosaicElement();
    $me->setType(new $typeClass());
	$mosaicElements[] = $me;
}

$mosaic = new Mosaic($mosaicElements);
$mosaic->prepareOutput();

?>
<div style="width: 600px; margin: 0 auto;">
	<div>
	<?php
	foreach($mosaic->getResultMosaic() as $k => $mosaicRow)
	{
	?>
		<div style="vertical-align: top">
			<?php
				foreach($mosaicRow->getMosaicElements() as $mosaicElement)
				{
                    if(is_array($mosaicElement))
                    {
                        echo '<div style="vertical-align: top; width: 300px; display: inline-block">';
                        foreach($mosaicElement as $me)
	                        drawElement($me);
                        echo '</div>';
                    }
                    else
                    {
					    drawElement($mosaicElement);
                    }
				}
			?>
		</div>
	<?php
	}
	?>
	</div>
</div>










<?php
function dump($ar, $title = '')
{

	echo '<pre style="background: black; color: tomato; font-size: 12px; min-height: 10px;">';
	if($title)
		echo '<h4 style=" color: #fff">' . $title .'</h4>';
	print_r($ar);
	echo '</pre>';
}

function drawElement($mosaicElement)
{
	switch($mosaicElement->getType()->getShortName())
	{
		case '<1h|1v>':
			$el = "<div style='border:1px dashed black; display: inline-block; width: 598px; height: 198px; background: tomato'>{$mosaicElement->getType()->getShortName()}</div>";
			break;
		case '<1/2h|1v>':
			$el = "<div style='border:1px dashed black; display: inline-block; width: 298px; height: 198px; background: limegreen'>{$mosaicElement->getType()->getShortName()}</div>";
			break;
		case '<1/2h|1/2v>':
			$el = "<div style='border:1px dashed black; display: inline-block; width: 298px; height: 98px; background: steelblue'>{$mosaicElement->getType()->getShortName()}</div>";
			break;
		case '<1/4h|1v>':
			$el = "<div style='border:1px dashed black; display: inline-block; width: 148px; height: 198px; background: teal'>{$mosaicElement->getType()->getShortName()}</div>";
			break;
	}
	echo $el;
}