# PHP Code Challenge

## Requirements

- PHP 7.4+
- Composer installed

## Installation

1) Clone repository to local directory
2) Run `composer install` to install dependencies

## Tests

Execute `vendor/bin/phpunit` (in the root dir of the project)

## Answer to challenge questions

- Execute `php index.php`
- The answers to the questions will be displayed on the console

## Alternative scenarios

To run alternative scenarios, execute `php index.php <scenario_name>`.

The actual scenarios are stored in dir `test_scenarios`:

- `scenario01`: default scenario (loaded by default if no scenario specified)
- `scenario02_error`: treats error when trying to add more than MAX_EXTRAS
- `scenario03_json`: loads data from JSON
