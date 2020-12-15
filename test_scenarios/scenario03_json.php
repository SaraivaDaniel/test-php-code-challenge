<?php

/*
 * This scenario assumes a stored representation of the electronic items bag using JSON
 * (it would also be possible to achieve a similar result with serialization/deserialization
 *  but in this case the string representation would be tied to PHP)
 */

use SaraivaDaniel\Constants;
use SaraivaDaniel\Importer\ElectronicItemFactory;
use SaraivaDaniel\Importer\LoadFromJson;

$json = <<<JSON
[
    {   
        "type": "television", 
        "data": { "price": 325.40 },
        "extras": [
            {
                "type": "controller",
                "data": { "price": 10, "wired": false }
            }
        ]
    }
]
JSON;

try {
    $factory = new ElectronicItemFactory(Constants::getClassMap());

    $loader = new LoadFromJson($factory);
    $scenario = $loader->load($json);
} catch (\Exception $e) {
    echo "Error loading from JSON: " . $e->getMessage() . "\n";
    exit(1);
}

// total pricing should be 335.40
echo "Total pricing: " . $scenario->getTotalPrice() . "\n";

