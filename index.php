<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\CsvReader;
use App\DataProcessor;

try {
    $csvReader = new CsvReader();
    $input = $csvReader->read(__DIR__ . '/input.csv');

    $dataProcessor = new DataProcessor();
    $similarityScore = $dataProcessor->process($input);

    echo $similarityScore . PHP_EOL;

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}
