<?php

require_once 'vendor/autoload.php';

$scenario_file = __DIR__ . DIRECTORY_SEPARATOR . 'test_scenarios' . DIRECTORY_SEPARATOR . ($argv[1] ?? 'scenario01') . '.php';
if (!file_exists($scenario_file)) {
    echo "Invalid or not found scenario file\n";
    exit(1);
}

try {
    /** @var \SaraivaDaniel\ElectronicItems $scenario */
    $scenario = require $scenario_file;
} catch (\Exception $e) {
    echo "Error loading scenario: " . $e->getMessage();
    exit(2);
}
