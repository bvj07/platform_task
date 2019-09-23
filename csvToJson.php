<?php
require_once 'functions.php';

// store the file path in a variable
$file = "products.csv";

// get the contents of the csv file
$csvData = file_get_contents($file);

// convert the csv data into an array
$productData = array_map("str_getcsv", explode("\n", $csvData));

// iterate through each product and build a new array grouped by the product PLU
foreach ($productData as $key => $val) { 
       
    // store the trimmed values into variables
    $sku    = trim($val[0]);
    $plu    = trim($val[1]);
    $name   = trim($val[2]);
    $size   = trim($val[3]);
    $sort   = trim($val[4]);
    
    // create array of required data for the 'addSize' function
    $sizeData = array(
        'sku'   => $sku,
        'size'  => $size,
        'sort'  => $sort
    );
    
    // Build the array grouped by the product PLU
    $products[$plu] = array(
        'PLU'   => $plu,
        'name'  => $name,
        'sizes' => addSize($sizeData, @$products[$plu]['sizes'])
    );
        
}

// Loop through the products array and remove all empty size values and remove array keys 
foreach ($products as $key => $val){
    $products[$key]['sizes'] = array_values(array_filter($val['sizes']));
}

//print_r($products);

// create the json object
$json = json_encode($products);
echo $json;
