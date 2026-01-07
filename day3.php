<?php


$batteries = explode("\n",file_get_contents('./batteries.txt'));

// $highestArray  = [];
// $total = 0;
// foreach($batteries as $battery ){

//     $battery = str_split($battery);

//     $currentTensValue = 0;
//     $highest = 0;
//     for($i=0; $i < count($battery) ; $i++){
//         if((int) $currentTensValue > $battery[$i] || ($i >= count($battery) - 1) ) continue;

//         $currentTensValue = (int)$battery[$i];

//         for($j=$i + 1; $j < count($battery) ; $j++){

//             $mergedValue = $battery[$i] . $battery[$j];

//             if((int)$mergedValue > (int)$highest){
//                 $highest = $mergedValue;
//                 continue;
//             }
//         }

        
//     }
//     $highestArray[] = $highest;
//     $total = $total + (int)$highest;
// }


/// DAY 2 - Find maximum joltage by selecting exactly 12 digits

$totalNumberOfJolts = 12;
$totalJoltage = 0;

foreach($batteries as $battery ){
    if (empty($battery)) continue;
    
    $digits = str_split($battery);
    $n = count($digits);
    $toRemove = $n - $totalNumberOfJolts;
    
    $stack = [];
    
    foreach($digits as $digit) {
        // While we can still remove digits AND current digit is greater than stack top
        while ($toRemove > 0 && !empty($stack) && end($stack) < $digit) {
            array_pop($stack);
            $toRemove--;
        }
        $stack[] = $digit;
    }
    
    // Take only the first 12 digits (in case we didn't remove enough)
    $result = array_slice($stack, 0, $totalNumberOfJolts);
    $joltage = implode('', $result);
    
    echo "Battery: $battery -> Joltage: $joltage\n";
    $totalJoltage += (int)$joltage;
}

echo "\nTotal Joltage: $totalJoltage\n";



// var_dump($total);