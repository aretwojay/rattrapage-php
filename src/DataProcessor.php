<?php

namespace App;

class DataProcessor
{
    private string $outputFilePath;

    public function __construct(string $outputFilePath = null)
    {
        $this->outputFilePath = $outputFilePath ?? __DIR__ . '/../sortedInput.json';
    }

    public function process(array $input): int
    {
        $columns = $this->extractColumns($input);
        $sortedColumns = $this->sortColumns($columns);
        
        $this->saveToJson($sortedColumns);
        
        return $this->calculateSimilarityScore($sortedColumns[0], $sortedColumns[1]);
    }

    private function extractColumns(array $input): array
    {
        $left = [];
        $right = [];

        foreach($input as $row) {
            if (isset($row[0])) {
                $left[] = $row[0];
            }
            if (isset($row[1])) {
                $right[] = $row[1];
            }
        }

        return [$left, $right];
    }

    private function sortColumns(array $columns): array
    {
        foreach ($columns as &$column) {
            sort($column);
        }
        return $columns;
    }

    private function saveToJson(array $data): void
    {
        file_put_contents($this->outputFilePath, json_encode($data, JSON_PRETTY_PRINT));
    }

    private function calculateSimilarityScore(array $leftList, array $rightList): int
    {
        $listWithMultiplier = [];

        foreach ($leftList as $value) {
            $listWithMultiplier[$value] = 0;
        }

        foreach ($rightList as $value) {
            if (array_key_exists($value, $listWithMultiplier)) {
                $listWithMultiplier[$value]++;
            }
        }

        $similarityScore = 0;

        foreach ($listWithMultiplier as $value => $multiplier) {
            $similarityScore += $value * $multiplier;
        }

        return $similarityScore;
    }
}
