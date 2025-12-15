<?php
ini_set('memory_limit', '2G');

$ranges = explode(",",file_get_contents('./ranges.txt'));

$rangeTotal = 0;

// // // Step 1

// // foreach($ranges as $range){
// //     [$lower, $upper] = explode("-", $range);
// //     // Process each range as needed
// //     for($i = (int)$lower; $i <= (int)$upper; $i++){
// //         // if the number is count of number is not even the continue
// //         $numberLength = (int)strlen($i) ;
// //         if($numberLength % 2 != 0) {

// //             // handle odd length numbers
// //             continue;

// //         };

// //         $firstHalf = substr($i, 0, $numberLength/2);
// //         $secondHalf = substr($i, $numberLength/2);
// //         if($firstHalf ===  $secondHalf){
// //             $rangeTotal = $rangeTotal + $i;
// //         }
// //     }
// // }

// // echo $rangeTotal ."\n";


foreach($ranges as $range){
    [$lower, $upper] = explode("-", $range);
    // Process each range as needed
    for($i = (int)$lower; $i <= (int)$upper; $i++){
        // if the number is count of number is not even the continue
        $numberLength = (int)strlen($i) ;
      
        $splitNumbers = findDivisiors($numberLength);

        foreach($splitNumbers as $splitNumber) {
            $arrays = str_split($i, $splitNumber);
            $allMatch = true;

            for($j=1; $j < count($arrays); $j++){
                if($arrays[0] !== $arrays[$j]){
                    $allMatch = false;  // Changed: set flag instead of break
                    break;
                }
            }
            if($allMatch && count($arrays) > 1) {  // count > 1 ensures it's actually repeated
                $rangeTotal = $rangeTotal + $i;
                break;  // NEW: stop checking other divisors once we find a match
            }



        }

       
    }
}
echo $rangeTotal ."\n";








function findDivisiors($num ){
    $divisors = [];
    for($i = 1; $i <= sqrt($num); $i++){
        if($num % $i == 0){
            $divisors[] = $i;
            if($i != $num / $i){  // NEW: avoid duplicates for perfect squares
                $divisors[] = $num / $i;
            }
        }
    }

    sort($divisors);
    $result = [];
    foreach($divisors as $divisor){
        if($divisor < $num){
            $result[] = $divisor;
        }
    }
    return $result;
}