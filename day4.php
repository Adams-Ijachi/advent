<?php

$lines = explode("\n",file_get_contents('./rolls.txt'));
$grid = [];
foreach($lines as $line){
    if ($line === '') continue; // skip empty trailing lines
    $grid[] = str_split($line);
}

if (empty($grid)) {
    print(0);
    exit;
}

$rowCount = count($grid);

$totalRemoved = 0;

// Repeat: find all accessible '@' rolls, mark as removed 'x', until none left
while (true) {
    $toRemove = [];

    for($row=0; $row < $rowCount; $row++){
        $colCountRow = count($grid[$row]);
        for($col=0 ; $col < $colCountRow; $col++){
            $value = $grid[$row][$col];
            if($value != "@") continue;

            $paperCount = findPaperCount($row, $col, $grid);

            // Accessible if fewer than 4 adjacent '@'
            if($paperCount < 4){
                $toRemove[] = [$row, $col];
            }
        }
    }

    if (empty($toRemove)) break;

    foreach ($toRemove as [$r, $c]) {
        // mark removed
        $grid[$r][$c] = 'x';
        $totalRemoved++;
    }
}

print($totalRemoved);

function findPaperCount($row, $col, $grid){
    $total = 0;

    // check top
    if($row != 0){
        $topRow = $row  - 1;
        // ensure column exists in top row
        if ($col < count($grid[$topRow])) {
            $topRowValue = $grid[$topRow][$col];
            if($topRowValue == "@")  $total++;
        }

        // check top left
        $leftValue = checkLeft($topRow, $col, $grid);
        if($leftValue == "@") $total++;

        //check top right 
        $rightValue = checkRight($topRow, $col, $grid);
        if($rightValue == "@") $total++;
    }

    // bottom
    if($row < count($grid) - 1 ){
        $bottomRow = $row  + 1;
        if ($col < count($grid[$bottomRow])) {
            $bottomRowValue = $grid[$bottomRow][$col];
            if($bottomRowValue == "@")  $total++;
        }

        // bottom left
        $leftValue = checkLeft($bottomRow, $col, $grid);
        if($leftValue == "@") $total++;

        // bottom right
        $rightValue = checkRight($bottomRow, $col, $grid);
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
        if ($leftIndex < count($grid[$row])) {
            $leftValue = $grid[$row][$leftIndex];
            return $leftValue;
        }
    }
    return null;
}

function checkRight($row, $col, $grid){
    if($col != count($grid[$row]) - 1){
        $rightIndex = $col + 1;
        if ($rightIndex < count($grid[$row])) {
            $rightValue = $grid[$row][$rightIndex];
            return $rightValue;
        }
    }
    return null;
}
