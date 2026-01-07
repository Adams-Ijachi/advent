<?php

$lines = explode("\n",file_get_contents('./rolls.txt'));
$grid = [];
foreach($lines as $line){
    $grid[] = str_split($line);
}
$rowNumber = count($grid[0]);
$total = 0;
for($row=0; $row <= count($grid) - 1; $row++){
    for($col=0 ; $col < $rowNumber; $col++){

        $value = $grid[$row][$col];

        if($value != "@") continue;

        $paperCount = findPaperCount($row, $col, $grid);

        if($paperCount < 4){
            $total++;
            continue;
        }


    }

}

 function findPaperCount($row, $col, $grid){
    $total = 0;

    // check top
      // first check if its the first row in grid 
    if($row != 0){
        // check top
        $topRow = $row  - 1;

        $topRowValue = $grid[$topRow][$col];
        if($topRowValue == "@")  $total++;

        // check top left

        $leftValue = checkLeft(row: $topRow,col:$col,grid:$grid );
        if($leftValue == "@") $total++;

        //check top right 
        $rightValue = checkRight(row: $topRow,col:$col,grid:$grid );
        if($rightValue == "@") $total++;


    }

    // buttom
    if($row < count($grid) - 1 ){
        $buttomRow = $row  + 1;
        $buttomRowValue = $grid[$buttomRow][$col];
        if($buttomRowValue == "@")  $total++;


        // buttom left
        $leftValue = checkLeft(row: $buttomRow,col:$col,grid:$grid );
        if($leftValue == "@") $total++;

        // buttom right
        $rightValue = checkRight(row: $buttomRow,col:$col,grid:$grid );
        if($rightValue == "@") $total++;
    }



    // left 
    if($col != 0 ){
        $leftIndex = $col - 1;
        $leftValue = $grid[$row][$leftIndex];
        if($leftValue == "@") $total++;
    }
    // right
    if($col != count($grid[$row]) - 1){
        $rightIndex = $col + 1;
        $rightValue = $grid[$row][$rightIndex];
        if($rightValue == "@") $total++;
    }


    return $total;

}

function checkLeft($row, $col, $grid){
     // left 
    if($col != 0 ){
        $leftIndex = $col - 1;
        $leftValue = $grid[$row][$leftIndex];
        return $leftValue;
        // if($leftValue == "@") $total++;
    }
}

function checkRight($row, $col, $grid){
    if($col != count($grid[$row]) - 1){
        $rightIndex = $col + 1;
        $rightValue = $grid[$row][$rightIndex];
        return $rightValue;
    }
}


print($total);


