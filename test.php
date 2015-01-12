<?php

include("shiprock.php");

$package = new Shiprock();
$package->createBox( array( "name" => "Letter A1", "id" => 1, "weight" => 4, "measures" => array( "length" => 18, "width" => 23.5, "height" => 2 ) ) );
$package->createBox( array( "name" => "Custom Envelope White Small", "id" => 2, "weight" => 4, "measures" => array( "length" => 23, "width" => 33, "height" => 4 ) ) );
$package->createBox( array( "name" => "Custom Envelope White Big", "id" => 3, "weight" => 4, "measures" => array( "length" => 32, "width" => 42, "height" => 5 ) ) );
$package->createBox( array( "name" => "Custom Small box", "id" => 4, "weight" => 60, "measures" => array( "length" => 16, "width" => 16, "height" => 16 ) ) );
$package->createBox( array( "name" => "Custom Medium box", "id" => 5, "weight" => 80, "measures" => array( "length" => 22, "width" => 20, "height" => 18 ) ) );
$package->createBox( array( "name" => "Custom Large box", "id" => 6, "weight" => 100, "measures" => array( "length" => 40, "width" => 30, "height" => 18 ) ) );
$package->createBox( array( "name" => "UPS Express Pak Small", "id" => 7, "weight" => 10, "measures" => array( "length" => 41, "width" => 32, "height" => 5 ) ) );
$package->createBox( array( "name" => "UPS Express Pak Big", "id" => 8, "weight" => 10, "measures" => array( "length" => 41, "width" => 46, "height" => 6.5 ) ) );
$package->createBox( array( "name" => "UPS Express Envelope", "id" => 9, "weight" => 10, "measures" => array( "length" => 34, "width" => 25, "height" => 5 ) ) );
$package->createBox( array( "name" => "UPS Express Box", "id" => 10, "weight" => 10, "measures" => array( "length" => 46, "width" => 31, "height" => 10 ) ) );
$package->createBox( array( "name" => "UPS Express Tube", "id" => 11, "weight" => 10, "measures" => array( "length" => 97, "width" => 16, "height" => 19 ) ) );

$package->createProductType( array( "type" => "tshirt", "flexible" => true, "measures" => array( "length" => 18, "width" => 23, "height" => 2 ) ) );
$package->createProductType( array( "type" => "hoodie", "flexible" => true, "measures" => array( "length" => 25, "width" => 34, "height" => 6 ) ) );
$package->createProductType( array( "type" => "mug", "flexible" => false, "measures" => array( "length" => 13, "width" => 10.5, "height" => 12.5 ) ) );
$package->createProductType( array( "type" => "sticker", "flexible" => false, "measures" => array( "length" => 6, "width" => 6, "height" => 0.10 ) ) );
$package->createProductType( array( "type" => "poster", "flexible" => false, "measures" => array( "length" => 6, "width" => 6, "height" => 50 ) ) );

//$package->addProduct( array( "type" => "tshirt", "quantity" => 4 ) );
//$package->addProduct( array( "type" => "hoodie", "quantity" => 2 ) );
//$package->addProduct( array( "type" => "sticker", "quantity" => 88 ) );
//$package->addProduct( array( "type" => "mug", "quantity" => 3 ) );
$package->addProduct( array( "type" => "poster", "quantity" => 1 ) );

$package->pack($filter = true);

echo "<pre>";
//print_r( $shiphero->boxesList );
//print_r( $shiphero->productsList );
print_r( $package->boxesList );

?>