<?php

// Comprehensive MongoDB Troubleshooting Script

function checkMongoDBExtension() {
    echo "Checking MongoDB Extension:\n";
    
    // Check PHP Extension
    if (extension_loaded('mongodb')) {
        echo "✓ MongoDB PHP Extension is loaded\n";
        echo "Extension Version: " . phpversion('mongodb') . "\n";
    } else {
        echo "✗ MongoDB PHP Extension is NOT loaded\n";
        return false;
    }

    return true;
}

function checkComposerPackages() {
    echo "\nChecking Composer Packages:\n";
    
    $packages = [
        'jenssegers/mongodb',
        'mongodb/mongodb'
    ];

    foreach ($packages as $package) {
        $output = [];
        $returnVar = null;
        exec("composer show {$package}", $output, $returnVar);
        
        if ($returnVar === 0) {
            echo "✓ Package {$package} is installed\n";
            echo implode("\n", array_slice($output, 0, 2)) . "\n";
        } else {
            echo "✗ Package {$package} is NOT installed\n";
        }
    }
}

function testMongoDBConnection() {
    echo "\nTesting MongoDB Connection:\n";
    
    try {
        $mongo = new MongoDB\Client('mongodb://localhost:27017');
        $databases = $mongo->listDatabases();
        
        echo "✓ MongoDB Connection Successful\n";
        echo "Available Databases:\n";
        foreach ($databases as $database) {
            echo " - " . $database->getName() . "\n";
        }
    } catch (\Exception $e) {
        echo "✗ MongoDB Connection Failed\n";
        echo "Error: " . $e->getMessage() . "\n";
    }
}

function checkLaravelMongoDBConfig() {
    echo "\nChecking Laravel MongoDB Configuration:\n";
    
    $connection = config('database.default');
    $config = config("database.connections.{$connection}");
    
    echo "Current Database Connection: {$connection}\n";
    print_r($config);
}

// Run Diagnostics
echo "MongoDB Diagnostic Tool\n";
echo "=====================\n\n";

checkMongoDBExtension();
checkComposerPackages();
testMongoDBConnection();
checkLaravelMongoDBConfig();