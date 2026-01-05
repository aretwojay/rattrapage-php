<?php

namespace App;

use Exception;

class CsvReader
{
    public function read(string $filePath): array
    {
        if (!file_exists($filePath)) {
            throw new Exception("File not found: $filePath");
        }

        $handle = fopen($filePath, 'r');
        if ($handle === false) {
            throw new Exception("Unable to open file: $filePath");
        }

        $input = [];
        $row = fgetcsv($handle, 1000, ',', '"', '\\');
        while ($row !== false) {
            $input[] = $row;
            $row = fgetcsv($handle, 1000, ',', '"', '\\');
        }
        fclose($handle);

        return $input;
    }
}
