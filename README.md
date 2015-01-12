# php-shiprock
Basic PHP class to estimate which box is the best solution to pack and ship your products. The script attempt to fill the items inside each box to find the smallest one and lower the shipping cost using some basic but effective calcs.
The script estimate the area of each box and product then return the filling percentage for each pack.

# Usage
Initialize

```$package = new Shiprock();```

Define your packaging
```
$package->createBox( array( "name" => "Letter A1", "weight" => 4, "measures" => array( "length" => 18, "width" => 23.5, "height" => 2 ) ) );
$package->createBox( array( "name" => "Custom Envelope White Small", "weight" => 4, "measures" => array( "length" => 23, "width" => 33, "height" => 4 ) ) );
$package->createBox( array( "name" => "Custom Envelope White Big","weight" => 4, "measures" => array( "length" => 32, "width" => 42, "height" => 5 ) ) );
$package->createBox( array( "name" => "Custom Small box", "weight" => 60, "measures" => array( "length" => 16, "width" => 16, "height" => 16 ) ) );
$package->createBox( array( "name" => "Custom Medium box", "weight" => 80, "measures" => array( "length" => 22, "width" => 20, "height" => 18 ) ) );
$package->createBox( array( "name" => "UPS Express Pak Small", "weight" => 10, "measures" => array( "length" => 41, "width" => 32, "height" => 5 ) ) );
```

Define your products type and size
```
$package->createProductType( array( "type" => "tshirt", "flexible" => true, "measures" => array( "length" => 18, "width" => 23, "height" => 2 ) ) );
$package->createProductType( array( "type" => "hoodie", "flexible" => true, "measures" => array( "length" => 25, "width" => 34, "height" => 6 ) ) );
$package->createProductType( array( "type" => "mug", "flexible" => false, "measures" => array( "length" => 13, "width" => 10.5, "height" => 12.5 ) ) );
$package->createProductType( array( "type" => "sticker", "flexible" => false, "measures" => array( "length" => 6, "width" => 6, "height" => 0.10 ) ) );
$package->createProductType( array( "type" => "poster", "flexible" => false, "measures" => array( "length" => 6, "width" => 6, "height" => 50 ) ) );
```

Define which products you want to pack
```
$package->addProduct( array( "type" => "tshirt", "quantity" => 4 ) );
$package->addProduct( array( "type" => "hoodie", "quantity" => 2 ) );
$package->addProduct( array( "type" => "mug", "quantity" => 3 ) );
```

Done!
```
$package->pack($filter = true);
```

This is a very first attempt to solve a complex problem (also called bin-packaging) in a simple way.

*Any help, feedback and improvement is really appreciated.*


### Next goals
1. Improve the code structure
2. Add multi-packaging support


**Thanks**
