<?php


$batteries = explode("\n",file_get_contents('./batteries.txt'));

$highestArray  = [];
$total = 0;
foreach($batteries as $battery ){

    $battery = str_split($battery);

    $currentTensValue = 0;
    $highest = 0;
    for($i=0; $i < count($battery) ; $i++){
        if((int) $currentTensValue > $battery[$i] || ($i >= count($battery) - 1) ) continue;

        $currentTensValue = (int)$battery[$i];

        for($j=$i + 1; $j < count($battery) ; $j++){

            $mergedValue = $battery[$i] . $battery[$j];

            if((int)$mergedValue > (int)$highest){
                $highest = $mergedValue;
                continue;
            }
        }

        
    }
    $highestArray[] = $highest;
    $total = $total + (int)$highest;
}

var_dump($total);