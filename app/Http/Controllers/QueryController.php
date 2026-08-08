<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SQLiteQueryService;
use Illuminate\Support\Facades\Log;

class QueryController extends Controller
{
    protected SQLiteQueryService $service;

    public function __construct(SQLiteQueryService $service)
    {
        $this->service = $service;
    }

    /**
     * SQL Editor Page
     */
    public function index()
    {
        return view('comparison.sql-editor');
    }

    /**
     * Execute SQL Query
     */
    public function execute(Request $request)
    {
        $request->validate([
            'query' => 'required|string'
        ]);

        try {

            $query = trim($request->input('query'));

            Log::info('SQL Query', [
                'query' => $query,
            ]);

            $result = $this->service->run($query);

            return response()->json($result);
        } catch (\Throwable $e) {

            Log::error('SQL Execute Error', [
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
            ]);

            return response()->json([
                'success' => false,
                'type'    => 'server_error',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Reload JSON files into SQLite Memory
     */
    public function reload()
    {
        try {

            $this->service->reload();

            return response()->json([
                'success' => true,
                'message' => 'Sample database reloaded successfully.'
            ]);
        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Export SQLite Memory tables to JSON
     */
    public function export()
    {
        try {

            $this->service->saveTablesToJson();

            return response()->json([
                'success' => true,
                'message' => 'JSON exported successfully.'
            ]);
        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
