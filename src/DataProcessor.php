<?php

namespace App;

class DataProcessor
{
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

        foreach ($input as $row) {
            $hasLeft = is_array($row) && array_key_exists(0, $row);
            $hasRight = is_array($row) && array_key_exists(1, $row);

            if ($hasLeft xor $hasRight) {
                throw new \InvalidArgumentException('Each row must contain both columns at index 0 and 1, or neither.');
            }

            if ($hasLeft && $hasRight) {
                $left[] = $row[0];
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
        $filePath = __DIR__ . '/../sortedInput.json';
        $result = file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT));

        if ($result === false) {
            throw new \RuntimeException('Failed to write JSON data to file: ' . $filePath);
        }
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
