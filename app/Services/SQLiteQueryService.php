<?php

// namespace App\Services;

// use PDO;

// class SQLiteQueryService
// {
//     private PDO $db;
//     private SQLValidatorService $validator;

//     public function __construct(
//         SQLValidatorService $validator
//     ) {
//         $this->validator =
//             $validator;
//         $this->db =
//             new PDO(
//                 "sqlite::memory:"
//             );
//         $this->db->setAttribute(
//             PDO::ATTR_ERRMODE,
//             PDO::ERRMODE_EXCEPTION
//         );
//         $this->loadJsonTables();
//     }
//     private function loadJsonTables()
//     {
//         $folder =
//             database_path(
//                 "sample"
//             );
//         $files =
//             glob(
//                 $folder . "/*.json"
//             );
//         foreach ($files as $file) {
//             $table =
//                 pathinfo(
//                     $file,
//                     PATHINFO_FILENAME
//                 );
//             $rows =
//                 json_decode(
//                     file_get_contents($file),
//                     true
//                 );
//             if (empty($rows)) {
//                 continue;
//             }
//             $columns =
//                 array_keys(
//                     $rows[0]
//                 );
//             $sql =
//                 "CREATE TABLE $table(";
//             foreach ($columns as $column) {

//                 $sql .=
//                     "$column TEXT,";
//             }
//             $sql =
//                 rtrim(
//                     $sql,
//                     ","
//                 );
//             $sql .= ")";
//             $this->db->exec(
//                 $sql
//             );
//             foreach ($rows as $row) {
//                 $fields =
//                     implode(
//                         ",",
//                         array_keys($row)
//                     );
//                 $values =
//                     array_map(
//                         function ($value) {

//                             return "'" .
//                                 str_replace(
//                                     "'",
//                                     "''",
//                                     $value
//                                 )
//                                 . "'";
//                         },
//                         array_values($row)
//                     );
//                 $insert =
//                     "INSERT INTO $table
//                 ($fields)
//                 VALUES
//                 (" . implode(
//                         ",",
//                         $values
//                     ) . ")";
//                 $this->db->exec(
//                     $insert
//                 );
//             }
//         }
//     }








//     public function run(
//         string $query
//     ) {


//         try {


//             /*
//              Validate SQL
//             */


//             $validation =
//                 $this->validator->validate(
//                     $query,
//                     $this->db
//                 );



//             if ($validation) {
//                 return $validation;
//             }





//             /*
//              Execute Query
//             */


//             $statement =
//                 $this->db->prepare(
//                     $query
//                 );



//             $statement->execute();




//             $command =
//                 strtoupper(
//                     explode(
//                         " ",
//                         trim($query)
//                     )[0]
//                 );






//             if ($command == "SELECT") {


//                 return [

//                     "success" => true,

//                     "type" => "table",

//                     "data" =>
//                     $statement->fetchAll(
//                         PDO::FETCH_ASSOC
//                     )

//                 ];
//             }







//             return [

//                 "success" => true,

//                 "type" => "message",

//                 "message" =>
//                 "Query executed successfully",


//                 "affected_rows" =>
//                 $statement->rowCount()

//             ];
//         } catch (\Exception $e) {


//             return [

//                 "success" => false,

//                 "type" => "sql_error",

//                 "error" =>
//                 $e->getMessage()

//             ];
//         }
//     }
// }


namespace App\Services;

use PDO;
use Exception;

class SQLiteQueryService
{
    /**
     * SQLite Connection
     */
    private PDO $db;

    /**
     * SQL Validator
     */
    private SQLValidatorService $validator;

    /**
     * JSON Folder
     */
    private string $jsonFolder;

    public function __construct(SQLValidatorService $validator)
    {
        $this->validator = $validator;

        $this->jsonFolder = database_path('sample');

        $this->createConnection();

        $this->loadJsonTables();
    }

    /**
     * Create SQLite Memory Database
     */
    private function createConnection(): void
    {
        $this->db = new PDO("sqlite::memory:");

        $this->db->setAttribute(
            PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION
        );

        $this->db->setAttribute(
            PDO::ATTR_DEFAULT_FETCH_MODE,
            PDO::FETCH_ASSOC
        );
    }

    /**
     * Reload JSON Database
     */
    public function reload(): void
    {
        $this->createConnection();

        $this->loadJsonTables();
    }

    /**
     * Import all JSON files into SQLite
     */
    private function loadJsonTables(): void
    {
        $files = glob($this->jsonFolder . '/*.json');

        if (!$files) {
            return;
        }

        foreach ($files as $file) {

            $table = pathinfo(
                $file,
                PATHINFO_FILENAME
            );

            $rows = json_decode(
                file_get_contents($file),
                true
            );

            if (
                !is_array($rows) ||
                empty($rows)
            ) {
                continue;
            }

            $columns = array_keys($rows[0]);

            /*
            |--------------------------------------------------------------------------
            | Create Table
            |--------------------------------------------------------------------------
            */

            $sql = "CREATE TABLE \"$table\" (";

            foreach ($columns as $column) {

                $sql .= "\"{$column}\" TEXT,";
            }

            $sql = rtrim($sql, ",");

            $sql .= ");";

            $this->db->exec($sql);

            /*
            |--------------------------------------------------------------------------
            | Insert Rows
            |--------------------------------------------------------------------------
            */

            $placeholders = implode(
                ",",
                array_fill(
                    0,
                    count($columns),
                    "?"
                )
            );

            $columnList = '"' .
                implode(
                    '","',
                    $columns
                ) .
                '"';

            $statement = $this->db->prepare(
                "INSERT INTO \"$table\" ($columnList)
                 VALUES ($placeholders)"
            );

            foreach ($rows as $row) {

                $values = [];

                foreach ($columns as $column) {

                    $values[] = $row[$column] ?? null;
                }

                $statement->execute($values);
            }
        }
    }
    /**
     * Execute SQL Query
     */
    public function run(string $query): array
    {
        try {

            $query = trim($query);

            /*
        |--------------------------------------------------------------------------
        | Validate Query
        |--------------------------------------------------------------------------
        */

            $validation = $this->validator->validate(
                $query,
                $this->db
            );

            if ($validation !== null) {
                return $validation;
            }

            /*
        |--------------------------------------------------------------------------
        | Execute Query
        |--------------------------------------------------------------------------
        */

            $statement = $this->db->prepare($query);

            $statement->execute();

            $command = strtoupper(
                strtok($query, ' ')
            );

            /*
        |--------------------------------------------------------------------------
        | SELECT
        |--------------------------------------------------------------------------
        */

            if ($command === 'SELECT') {

                return [
                    'success' => true,
                    'type'    => 'table',
                    'rows'    => $statement->rowCount(),
                    'data'    => $statement->fetchAll(PDO::FETCH_ASSOC),
                ];
            }

            /*
        |--------------------------------------------------------------------------
        | INSERT / UPDATE / DELETE
        |--------------------------------------------------------------------------
        */

            if (in_array($command, [
                'INSERT',
                'UPDATE',
                'DELETE'
            ])) {

                // Save SQLite back to JSON
                $this->saveTablesToJson();

                return [
                    'success'       => true,
                    'type'          => 'message',
                    'message'       => $command . ' executed successfully.',
                    'affected_rows' => $statement->rowCount(),
                ];
            }

            /*
        |--------------------------------------------------------------------------
        | Other Commands
        |--------------------------------------------------------------------------
        */

            return [
                'success' => true,
                'type'    => 'message',
                'message' => 'Query executed successfully.',
            ];
        } catch (Exception $e) {

            return [
                'success' => false,
                'type'    => 'sql_error',
                'error'   => $e->getMessage(),
            ];
        }
    }
    /**
     * Export all SQLite tables back to JSON files
     */
    public function saveTablesToJson(): void
    {
        foreach ($this->getTableNames() as $table) {

            $statement = $this->db->query(
                'SELECT * FROM "' . $table . '"'
            );

            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

            file_put_contents(
                $this->jsonFolder . DIRECTORY_SEPARATOR . $table . '.json',
                json_encode(
                    $rows,
                    JSON_PRETTY_PRINT |
                        JSON_UNESCAPED_UNICODE |
                        JSON_UNESCAPED_SLASHES
                )
            );
        }
    }

    /**
     * Get all table names
     */
    private function getTableNames(): array
    {
        $statement = $this->db->query("
        SELECT name
        FROM sqlite_master
        WHERE type='table'
        ORDER BY name
    ");

        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * Check whether a table exists
     */
    private function tableExists(string $table): bool
    {
        $statement = $this->db->prepare("
        SELECT name
        FROM sqlite_master
        WHERE type='table'
        AND name = ?
    ");

        $statement->execute([$table]);

        return (bool) $statement->fetchColumn();
    }

    /**
     * Get all rows from a table
     */
    private function getTableData(string $table): array
    {
        if (!$this->tableExists($table)) {
            return [];
        }

        $statement = $this->db->query(
            'SELECT * FROM "' . $table . '"'
        );

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
