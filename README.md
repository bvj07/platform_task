# platform_task
Import CSV Product Data

This project takes csv data and converts it into a Json object and stores it as a string in a text file.

The programme is run in 'csvToJson.php'

It pulls csv data from 'products.csv' and converts it into a php array.

An associative array is then created to group all products by their PLU (product listing unit).

Sizes are added to the array using two functions from 'functions.php' that allow product sizes to be listed in order depending on their sort type.

The array is converted into a json object and written to 'jsonData.txt'
