<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;
use MongoDB\Client;

class MongoDBDiagnosticProvider extends ServiceProvider
{
    public function register()
    {
        // Bind MongoDB Client to the service container
        $this->app->bind(Client::class, function () {
            return new Client(env('MONGODB_URI', 'mongodb://localhost:27017'));
        });
    }

    public function boot()
    {
        try {
            // Use dependency injection
            $mongo = $this->app->make(Client::class);
            $databases = $mongo->listDatabases();
            
            Log::info('MongoDB Connection Successful', [
                'databases' => array_map(function($db) { 
                    return $db->getName(); 
                }, iterator_to_array($databases))
            ]);
        } catch (\Exception $e) {
            Log::error('MongoDB Connection Failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
}