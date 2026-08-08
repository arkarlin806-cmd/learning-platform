<?php

// namespace App\Services;

// use PDO;

// class SQLValidatorService
// {
//     public function validate(
//         string $query,
//         PDO $db
//     ) {
//         $error =
//             $this->checkKeyword($query);
//         if ($error) {
//             return $error;
//         }
//         $error =
//             $this->checkTable(
//                 $query,
//                 $db
//             );

//         if ($error) {
//             return $error;
//         }
//         $error =
//             $this->checkColumn(
//                 $query,
//                 $db
//             );
//         if ($error) {
//             return $error;
//         }
//         return null;
//     }
//     private function checkKeyword(
//         $query
//     ) {
//         $firstWord =
//             strtoupper(
//                 explode(
//                     " ",
//                     trim($query)
//                 )[0]
//             );
//         $allowed = [
//             "SELECT",
//             "INSERT",
//             "UPDATE",
//             "DELETE"

//         ];
//         if (
//             !in_array(
//                 $firstWord,
//                 $allowed
//             )
//         ) {
//             return [
//                 "success" => false,
//                 "type" => "keyword",
//                 "error" =>
//                 "Unknown SQL keyword: " . $firstWord,
//                 "message" =>
//                 "SQL command must start with SELECT, INSERT, UPDATE or DELETE"
//             ];
//         }
//         return null;
//     }
//     private function checkTable(
//         $query,
//         PDO $db
//     ) {
//         preg_match_all(
//             '/FROM\s+(\w+)|JOIN\s+(\w+)|INTO\s+(\w+)|UPDATE\s+(\w+)/i',
//             $query,
//             $matches
//         );
//         $tables =
//             array_merge(

//                 $matches[1],
//                 $matches[2],
//                 $matches[3],
//                 $matches[4]

//             );
//         $tables =
//             array_filter(
//                 $tables
//             );
//         $available =
//             $db->query(
//                 "SELECT name FROM sqlite_master WHERE type='table'"
//             )
//             ->fetchAll(
//                 PDO::FETCH_COLUMN
//             );
//         foreach ($tables as $table) {
//             if (
//                 !in_array(
//                     $table,
//                     $available
//                 )
//             ) {
//                 return [
//                     "success" => false,
//                     "type" => "table",
//                     "error" =>
//                     "Table '$table' not found",
//                     "available_tables" =>
//                     $available

//                 ];
//             }
//         }
//         return null;
//     }
//     private function checkColumn(
//         $query,
//         PDO $db
//     ) {
//         preg_match(
//             '/FROM\s+(\w+)/i',
//             $query,
//             $tableMatch
//         );
//         if (!$tableMatch) {
//             return null;
//         }
//         $table =
//             $tableMatch[1];
//         preg_match(
//             '/SELECT\s+(.*?)\s+FROM/i',
//             $query,
//             $columnMatch
//         );
//         if (!$columnMatch) {
//             return null;
//         }
//         $columns =
//             trim(
//                 $columnMatch[1]
//             );
//         if ($columns == "*") {
//             return null;
//         }
//         $available =
//             $db->query(
//                 "PRAGMA table_info($table)"
//             )
//             ->fetchAll(
//                 PDO::FETCH_COLUMN,
//                 1
//             );
//         foreach (
//             explode(
//                 ",",
//                 $columns
//             )
//             as $column
//         ) {
//             $column =
//                 trim($column);
//             if (
//                 !in_array(
//                     $column,
//                     $available
//                 )
//             ) {
//                 return [

//                     "success" => false,

//                     "type" => "column",
//                     "error" =>
//                     "Column '$column' does not exist",


//                     "available_columns" =>
//                     $available

//                 ];
//             }
//         }
//         return null;
//     }
// }


namespace App\Services;

use PDO;

class SQLValidatorService
{
    /**
     * Validate SQL query before execution.
     */
    public function validate(string $query, PDO $db): ?array
    {
        $query = trim($query);

        if ($query === '') {
            return [
                'success' => false,
                'type'    => 'query',
                'error'   => 'Query cannot be empty.'
            ];
        }

        // Check SQL keyword
        $error = $this->checkKeyword($query);
        if ($error) {
            return $error;
        }

        // Check table exists
        $error = $this->checkTable($query, $db);
        if ($error) {
            return $error;
        }

        // Check column exists
        $error = $this->checkColumn($query, $db);
        if ($error) {
            return $error;
        }

        return null;
    }

    /**
     * Validate SQL command.
     */
    private function checkKeyword(string $query): ?array
    {
        $firstWord = strtoupper(
            strtok(trim($query), " ")
        );

        $allowed = [
            'SELECT',
            'INSERT',
            'UPDATE',
            'DELETE'
        ];

        if (!in_array($firstWord, $allowed)) {

            return [
                'success' => false,
                'type'    => 'keyword',
                'error'   => "Unknown SQL keyword: {$firstWord}",
                'message' => 'SQL command must start with SELECT, INSERT, UPDATE or DELETE.'
            ];
        }

        return null;
    }

    /**
     * Validate table exists.
     */
    private function checkTable(string $query, PDO $db): ?array
    {
        preg_match_all(
            '/FROM\s+(\w+)|JOIN\s+(\w+)|INTO\s+(\w+)|UPDATE\s+(\w+)/i',
            $query,
            $matches
        );

        $tables = array_filter(
            array_merge(
                $matches[1],
                $matches[2],
                $matches[3],
                $matches[4]
            )
        );

        if (empty($tables)) {
            return null;
        }

        $availableTables = $db
            ->query("SELECT name FROM sqlite_master WHERE type='table'")
            ->fetchAll(PDO::FETCH_COLUMN);

        foreach ($tables as $table) {

            if (!in_array($table, $availableTables)) {

                return [
                    'success'          => false,
                    'type'             => 'table',
                    'error'            => "Table '{$table}' not found.",
                    'available_tables' => $availableTables
                ];
            }
        }

        return null;
    }

    /**
     * Validate selected columns.
     */
    private function checkColumn(string $query, PDO $db): ?array
    {
        if (!preg_match('/SELECT\s+(.*?)\s+FROM\s+(\w+)/is', $query, $matches)) {
            return null;
        }

        $columnString = trim($matches[1]);
        $table = trim($matches[2]);

        if ($columnString === '*') {
            return null;
        }

        $availableColumns = $db
            ->query("PRAGMA table_info($table)")
            ->fetchAll(PDO::FETCH_ASSOC);

        $columns = [];

        foreach ($availableColumns as $column) {
            $columns[] = $column['name'];
        }

        $selectedColumns = explode(',', $columnString);

        foreach ($selectedColumns as $column) {

            $column = trim($column);

            // Remove alias
            if (stripos($column, ' AS ') !== false) {
                $parts = preg_split('/\s+AS\s+/i', $column);
                $column = trim($parts[0]);
            }

            // Remove table prefix
            if (str_contains($column, '.')) {
                $column = explode('.', $column)[1];
            }

            // Ignore SQL functions
            if (
                preg_match(
                    '/COUNT|SUM|AVG|MIN|MAX|DISTINCT|\(/i',
                    $column
                )
            ) {
                continue;
            }

            if (!in_array($column, $columns)) {
                return [
                    'success'           => false,
                    'type'              => 'column',
                    'error'             => "Column '{$column}' does not exist.",
                    'available_columns' => $columns
                ];
            }
        }

        return null;
    }
}
