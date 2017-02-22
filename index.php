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


//echo '<pre>';
//print_r($mosaicElements);
//echo '</pre>';
//dump($mosaicElements);
$mosaic = new Mosaic([
	$mosaicElement7,
	$mosaicElement1,
	$mosaicElement2,
	$mosaicElement8,
	$mosaicElement5,
	$mosaicElement3,
	$mosaicElement4,
	$mosaicElement6,
]);
//dump($mosaic->getResultMosaic(), 'resultMosaic!!!');
//die();
?>
<div style="width: 600px; margin: 0 auto;">
	<table>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	<?php
	foreach($mosaic->getResultMosaic() as $k => $mosaicRow)
	{
	?>
		<tr>
			<?php
				foreach($mosaicRow->getMosaicElements() as $mosaicElement)
				{

					switch($mosaicElement->getType()->getShortName())
					{
						case '<1h|1v>':
							$el = "<td colspan='4' style=' width: 600px; height: 200px; background: tomato'></td>";
						break;
						case '<1/2h|1v>':
							$el = "<td style='width: 300px; height: 200px; background: limegreen'></td>";
						break;
						case '<1/2h|1/2v>':
							$el = "<td style='width: 300px; height: 100px; background: steelblue'></td>";
						break;
						case '<1/4h|1v>':
							$el = "<td style='width: 150px; height: 200px; background: teal'></td>";
						break;
					}
					echo $el;
				}
			?>
		</tr>
	<?php
	}
	?>
	</table>
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