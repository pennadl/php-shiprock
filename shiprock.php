<?php

class Shiprock {

  public $boxesList = array();
  public $productsList = array();
  public $shipProducts = array();

  public function createBox( $array ) {
    if ( !isset( $array["volume"] ) ) {
      $array["volume"] = ( $array["measures"]["width"] * $array["measures"]["length"] * $array["measures"]["height"] );
    }
    array_push( $this->boxesList, $array );
  }

  public function createProductType( $array ) {
    if ( !isset( $array["volume"] ) ) {
      $array["volume"] = ( $array["measures"]["width"] * $array["measures"]["length"] * $array["measures"]["height"] );
    }
    array_push( $this->productsList, $array );
  }

  public function addProduct( $array ) {
    array_push( $this->shipProducts, $array );
  }

  private function calculateFill() {
    foreach ( $this->boxesList as $box ) {
      foreach ( $this->productsList as $key => $product ) {
        $exclude_box = 0;
        if ( !isset( $this->productsList[$key]["boxes"] ) ) {
          $this->productsList[$key]["boxes"] = array();
        }

        if ( !isset( $this->productsList[$key]["exclude_boxes"] ) ) {
          $this->productsList[$key]["exclude_boxes"] = array();
        }

        foreach ( $this->productsList[$key]["measures"] as $product_measure ) {
          $oversize = 0;
          foreach ( $box["measures"] as $box_measure ) {
            if ( $product_measure > $box_measure && $product["flexible"] == false ) {
              $oversize++;
            }
          }

          if ( $oversize == 3 ) {
            $exclude_box = 1;
          }
        }

        $fill = number_format( ( ( $this->productsList[$key]["volume"] * 100 ) / $box["volume"] ), 3 );

        array_push( $this->productsList[$key]["boxes"], array( "name" => $box["name"], "fill" => $fill, "exclude" => $exclude_box ) );
      }
    }
  }

  public function findWhere( $array, $matching ) {
    foreach ( $array as $item ) {
      $is_match = true;
      foreach ( $matching as $key => $value ) {

        if ( is_object( $item ) ) {
          if ( ! isset( $item->$key ) ) {
            $is_match = false;
            break;
          }
        } else {
          if ( ! isset( $item[$key] ) ) {
            $is_match = false;
            break;
          }
        }

        if ( is_object( $item ) ) {
          if ( $item->$key != $value ) {
            $is_match = false;
            break;
          }
        } else {
          if ( $item[$key] != $value ) {
            $is_match = false;
            break;
          }
        }
      }

      if ( $is_match ) {
        return $item;
      }
    }

    return false;
  }

  public function pack($filter) {
    $this->calculateFill();

    $available_boxes = array();
    $min_size = 0;

    foreach ( $this->shipProducts as $shipProduct ) {
      $product_type = $this->findWhere( $this->productsList, array( "type" => $shipProduct["type"] ) ); //Get the product type specs
      $min_size += ( min( $product_type["measures"] ) * $shipProduct["quantity"] ); //Add the smallest side to min_size
      foreach ( $product_type["boxes"] as $box ) {
        $original_box = $this->findWhere( $this->boxesList, array( "name" => $box["name"] ) ); //Get the original box data
        if ( $box["exclude"] == 0 ) {
          $available_boxes[$box["name"]]["name"] = $box["name"];
          $available_boxes[$box["name"]]["fill"] += $box["fill"] * $shipProduct["quantity"];
          $available_boxes[$box["name"]]["exclude"] = 0;

          //Calculate the smallest side of the packed items and check if can fit into the box
          if ( $min_size > max( $original_box["measures"] ) ) {
            $available_boxes[$box["name"]]["exclude"] = 1;
          }

          //Exclude the box if the fill rate is greater than 100%
          if ( $available_boxes[$box["name"]]["fill"] > 100 )
            $available_boxes[$box["name"]]["exclude"] = 1;
        }
      }
    }

    //Sort boxes from the most to the less filled
    foreach ( $available_boxes as $key => $row ) {
      $fill[$key] = $row["fill"];
    }
    array_multisort( $fill, SORT_DESC, $available_boxes );

    //Filter only packages that can fit the items
    if($filter)
      $available_boxes = array_filter( $available_boxes, function( $el ) { return $el["exclude"] != 1; } );

    $this->boxesList = $available_boxes;

  }

}

?>
