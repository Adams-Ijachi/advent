<?php
ini_set('memory_limit', '2G');

$ranges = explode(",",file_get_contents('./ranges.txt'));

$rangeTotal = 0;

// Cache divisors for each length (lengths repeat a LOT)
$divisorCache = [];

foreach($ranges as $range){
    [$lower, $upper] = explode("-", $range);
    
    for($i = (int)$lower; $i <= (int)$upper; $i++){
        $numberLength = strlen((string)$i);  // Removed unnecessary (int) cast
        
        // Use cached divisors if we've seen this length before
        if(!isset($divisorCache[$numberLength])){
            $divisorCache[$numberLength] = findDivisiors($numberLength);
        }
        $splitNumbers = $divisorCache[$numberLength];

        foreach($splitNumbers as $splitNumber) {
            // Convert to string once instead of in str_split
            $numStr = (string)$i;
            $pattern = substr($numStr, 0, $splitNumber);
            
            // Use string repetition instead of splitting into array
            $repeated = str_repeat($pattern, $numberLength / $splitNumber);
            
            if($numStr === $repeated) {
                $rangeTotal += $i;
                break;
            }
        }
    }
}

echo $rangeTotal ."\n";

function findDivisiors($num){
    $divisors = [];
    for($i = 1; $i <= sqrt($num); $i++){
        if($num % $i == 0){
            $divisors[] = $i;
            if($i != $num / $i && $num / $i != $num){  // Skip the number itself
                $divisors[] = $num / $i;
            }
        }
    }
    
    sort($divisors);
    $result = [];
    foreach($divisors as $divisor){
        if($divisor > 1 && $divisor < $num){
            $result[] = $divisor;
        }
    }
    return $result;
}