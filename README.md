Mosaic blocks
=============
Php algorithm for creating the mosaic of blocks.

Simple Example
--------------
```php
// create from 20 to 30 random elements
$randomElements = mt_rand(20, 30);
$mosaicElements = [];
$arMosaicTypes = [
    MosaicTypeFullHorizontalFullVertical::class,
    MosaicTypeHalfHorizontalFullVertical::class,
    MosaicTypeHalfHorizontalHalfVertical::class,
    MosaicTypeQuarterHorizontalFullVertical::class,
    MosaicTypeThreeQuarterHorizontalFullVertical::class
];

for ($i = 0; $i < $randomElements; $i++) {
    //get random type
    $typeClassIndex = array_rand($arMosaicTypes);
    $typeClass = $arMosaicTypes[$typeClassIndex];
    $me = new MosaicElement();
    //and set to new MosaicElement
    $me->setType(new $typeClass());
    $me->setId($i);
    $mosaicElements[] = $me;
}

// or get elements from database
// now we have random list of mosaic elements
$mosaic = new Mosaic($mosaicElements);
$mosaic->prepareOutput();

//loop througn mosaic rows
foreach ($mosaic->getResultMosaic() as $k => $mosaicRow) {
	foreach ($mosaicRow->getMosaicElements() as $mosaicElement) {
	    // and output your html
	}
}
```