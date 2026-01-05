<?php

$handle = fopen(__DIR__ . '/input.csv', 'r');
$row = fgetcsv($handle, 1000, ',', '"', '\\');
$input = [];
while($row !== false) {
    $input[] = $row;
    $row = fgetcsv($handle, 1000, ',', '"', '\\');
}
fclose($handle);

$localisationLeftList = [];
$localisationRightList = [];

foreach($input as $row) {
    $localisationLeftList[] = $row[0];
    $localisationRightList[] = $row[1];
}

$input = [$localisationLeftList, $localisationRightList];

for($i = 0; $i < count($input); $i++) {
    sort($input[$i]);
}

file_put_contents(__DIR__ . '/sortedInput.json', json_encode($input, JSON_PRETTY_PRINT));

$greatestList = $input[0];

for($i = 1; $i < count($input); $i++) {
    if(count($input[$i]) > count($greatestList)) {
        $greatestList = $input[$i];
    }
}

$listWithMultiplier = [];

for($i = 0; $i < count($input[0]); $i++) {
    $listWithMultiplier[$input[0][$i]] = 0;
}

for($i = 0; $i < count($input[1]); $i++) {
    $value  = $input[1][$i];
    if(array_key_exists($value, $listWithMultiplier)) {
        $listWithMultiplier[$value]++;
    }
}

$similarityScore = 0;

foreach($listWithMultiplier as $value=>$multiplier) {
    $similarityScore += $value * $multiplier;
}

echo $similarityScore . PHP_EOL;
