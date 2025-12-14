<?php


$passoword = explode("\n",file_get_contents('./password.txt'));

// print_r($passoword);
$startingPoint = 50;
$numberOfZeros = 0;
foreach($passoword as $combination){
    $leftDirection = str_starts_with($combination, 'L');
    $rightDirection = str_starts_with($combination, 'R');

    if($leftDirection){
        $numberOfRotation = substr($combination, 1);
        $currentPosition  = ($startingPoint - (int)$numberOfRotation );
        
        if($currentPosition > 0){
            $startingPoint = $currentPosition;
        }else{
           
             while($currentPosition < 0 ){
                $currentPosition = $currentPosition + 100;
            }
            $startingPoint = $currentPosition ;
        }
        
    }
    
    if($rightDirection){
        $numberOfRotation = substr($combination, 1);
        $currentPosition  = ($startingPoint  + (int)$numberOfRotation );
        
        if($currentPosition < 100){
            $startingPoint = $currentPosition;
        }else{
            
            while($currentPosition > 100){
                $currentPosition = $currentPosition - 100;
            }
            $startingPoint = $currentPosition ;

        }
    }


    if($startingPoint == 0 || $startingPoint == 100){
        //  $startingPoint;
        $numberOfZeros++;
    }
   
}

var_dump($numberOfZeros);
