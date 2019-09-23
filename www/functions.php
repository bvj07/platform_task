<?php

/**
 * This takes an array containing size data for a product and adds new data
 * as a new array value. It calls the function 'setSizeSort' so sizes can be
 * listed in order by sort type.
 * 
 * @param array $sizeData - new size info
 * @param array $sizeArray - original size array
 * @return array
 */
function addSize($sizeData, $sizeArray){
    
    // if the size array has not been set then call 'setSizeSort' function
    // that creates the empty array key order
    if(!is_array($sizeArray)){
        $sizeArray = setSizeSort($sizeData['sort']);
    }
    
    // create the size array key that will match whats been set in 'setSizeSort'
    $sizeKey = trim(str_replace(' ', '', strtoupper($sizeData['size'])));
    
    // push the size and sku data to the array containing all sizes 
    $sizeArray[$sizeKey] = array(
        'SKU'       => $sizeData['sku'],
        'size'      => $sizeData['size']
    ); 
    
    // return the new size array
    return $sizeArray;
}

/**
 * This function returns an empty associative array with key values dependant 
 * on the 'sizeSort' type.
 * 
 * @param string $sizeSort
 * @return empty assoc array
 */
function setSizeSort($sizeSort){
    
    // default will be an empty array so no sorting will occur
    // sizes will be displayed in order they come in.
    $keys = array();

    // if the sort type is SHOE_UK iterate 1-12 child, then 1-20 adult 
    // including half sizes
    if($sizeSort == 'SHOE_UK'){
        for($i=1; $i<=12; $i += 0.5 ){
            $keys[] = $i.'(CHILD)';
        }
        for($i=1; $i<=20; $i += 0.5 ){
            $keys[] = $i;
        }
    }
    
    // if the sort type is SHOE_EU iterate 20-50 
    if($sizeSort == 'SHOE_EU'){
        for($i=20; $i<=50; $i++){
            $keys[] = $i;
        }
    }
    
    // if sort type is CLOTHING_SHORT then set array from xs-xxxxl
    if($sizeSort == 'CLOTHING_SHORT'){
        $keys = array('XS','S','M','L','XL','XXL','XXXL','XXXXL');
    }
     
    // return assoc array of keys with null values
    return array_fill_keys($keys, null);
}
