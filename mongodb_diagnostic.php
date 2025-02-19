<?php

// Comprehensive MongoDB Diagnostic Script

// Check PHP Extensions
echo "PHP Extensions Check:\n";
$requiredExtensions = ['mongodb', 'openssl'];
foreach ($requiredExtensions as $ext) {
    echo " - {$ext}: " . (extension_loaded($ext) ? "✓ Loaded" : "✗ Not Loaded") . "\n";
}

// Check Composer Packages
echo "\nComposer Packages Check:\n";
$output = [];
exec('composer show mongodb/mongodb', $output);
print_r($output);

// Test MongoDB Connection
echo "\nMongoDB Connection Test:\n";
try {
    $mongo = new MongoDB\Client('mongodb://localhost:27017');
    $databases = $mongo->listDatabases();
    
    echo "Connection Successful!\n";
    echo "Available Databases:\n";
    foreach ($databases as $database) {
        echo " - " . $database->getName() . "\n";
    }
} catch (\Exception $e) {
    echo "Connection Failed: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}

// Laravel MongoDB Configuration
echo "\nLaravel MongoDB Configuration:\n";
$connection = config('database.default');
$config = config("database.connections.{$connection}");
print_r($config);