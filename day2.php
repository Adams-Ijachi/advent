<?php

$ranges = explode(",",file_get_contents('./ranges.txt'));

$rangeTotal = 0;

// Step 1

// foreach($ranges as $range){
//     [$lower, $upper] = explode("-", $range);
//     // Process each range as needed
//     for($i = (int)$lower; $i <= (int)$upper; $i++){
//         // if the number is count of number is not even the continue
//         $numberLength = (int)strlen($i) ;
//         if($numberLength % 2 != 0) continue;

//         $firstHalf = substr($i, 0, $numberLength/2);
//         $secondHalf = substr($i, $numberLength/2);
//         if($firstHalf ===  $secondHalf){
//             $rangeTotal = $rangeTotal + $i;
//         }
//     }
// }

// echo $rangeTotal ."\n";


function findValue($array)
{
    $currentNumber = $array[0];

    if(count($array)< 2){
        return $array[0];
    }

    // find first occurance
    $index = 1;
    while (  $array[$index] != $currentNumber ){

        if($index >= count ($array) -1 ){
            return false;
        }
        $index++;
    }
    $cutout = array_slice($array, $index);

    findValue($cutout);

    return $array;
}

$numberTotal = [];
$values =[];

foreach($ranges as $range){
    [$lower, $upper] = explode("-", $range);
    // Process each range as needed
    for($i = (int)$lower; $i <= (int)$upper; $i++){
        
        $arrayOfNumber = str_split($i);
        
        $node = findValue($arrayOfNumber);
        if(!$node){
            continue;
        }

        $values[] = $node;

        
    }
}
