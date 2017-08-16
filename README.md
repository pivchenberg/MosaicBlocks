Mosaic blocks
=============
Php algorithm for creating the mosaic of blocks.

## Installation
```bash
$ composer require pivchenberg/mosaic-blocks
```

## Simple Example
```php
<?php 

// Get list of mosaic elements
$mosaicElements = [
    new MosaicElement(new MosaicTypeFullHorizontalFullVertical()),
    new MosaicElement(new MosaicTypeHalfHorizontalHalfVertical()),
    new MosaicElement(new MosaicTypeQuarterHorizontalFullVertical()),
    new MosaicElement(new MosaicTypeHalfHorizontalHalfVertical()),
    new MosaicElement(new MosaicTypeQuarterHorizontalFullVertical()),
    new MosaicElement(new MosaicTypeHalfHorizontalFullVertical()),
    new MosaicElement(new MosaicTypeThreeQuarterHorizontalFullVertical()),
    new MosaicElement(new MosaicTypeQuarterHorizontalFullVertical()),
    new MosaicElement(new MosaicTypeQuarterHorizontalFullVertical()),
    new MosaicElement(new MosaicTypeQuarterHorizontalFullVertical()),
    new MosaicElement(new MosaicTypeQuarterHorizontalFullVertical()),
    new MosaicElement(new MosaicTypeThreeQuarterHorizontalFullVertical()),
];

// Pass it to Mosaic construct
$mosaic = new Mosaic($mosaicElements);
$mosaic->prepareOutput();

// Loop througn mosaic rows
foreach ($mosaic->getResultMosaic() as $k => $mosaicRow) {
	foreach ($mosaicRow->getMosaicElements() as $mosaicElement) {
	    // And output your html
	}
}
```

## MosaicElement
MosaicElement only contains type of mosaic, so you can easy create your own mosaic element class
```php
<?php

use Pivchenberg\MosaicBlocks\Mosaic\MosaicElementInterface;
use Pivchenberg\MosaicBlocks\MosaicType\MosaicTypeInterface;

class MyClass implements MosaicElementInterface 
{
    protected $mosaicType;
    
    /**
     * @return MosaicTypeInterface
     */
    public function getMosaicType() 
    {
        return $this->mosaicType;
    }
}
```
> [Example code](https://github.com/pivchenberg/mosaicExample)
