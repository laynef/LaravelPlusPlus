<?php

require __DIR__ . '/help/documentation.php';
require __DIR__ . '/help/initialize.php';
require __DIR__ . '/help/make_test.php';
require __DIR__ . '/help/model.php';
require __DIR__ . '/help/update_version.php';
require __DIR__ . '/commands/initialize.php';
require __DIR__ . '/commands/make_test.php';
require __DIR__ . '/commands/model.php';
require __DIR__ . '/commands/update_version.php';


class LaravelPlusPlus
{

    public $error_string = 'ERROR: Must make laravelpp commands in the laravel root directory';
    public $not_found_string = 'ERROR: Your package cound not be found please reinstall';

    public $command_name_lookup = [
        'i' => InitializeCommand,
        'init' => InitializeCommand,
        'initialize' => InitializeCommand,
        'm' => ModelCommand,
        'model' => ModelCommand,
        'mt' => MakeTestCommand,
        'make_test' => ModelTestCommand,
        'uv' => UpdateVersionCommand,
        'update_version' => UpdateVersionCommand,
    ];

    public $command_name_help_lookup = [
        'i' => InitializeHelpCommand,
        'init' => InitializeHelpCommand,
        'initialize' => InitializeHelpCommand,
        'm' => ModelHelpCommand,
        'model' => ModelHelpCommand,
        'mt' => MakeTestHelpCommand,
        'make_test' => ModelTestHelpCommand,
        'uv' => UpdateVersionHelpCommand,
        'update_version' => UpdateVersionHelpCommand,
    ];

    public $descriptions = array(
        '- i => Initialize your project',
        '- init => Initialize your project',
        '- initialize => Initialize your project',
        '- m => Generate your CRUD model, controller, and migration',
        '- model => Generate your CRUD model, controller, and migration',
        '- mt => Generate your resource phpunit test',
        '- make_test => Generate your resource phpunit test',
        '- uv => Update your code base with the latest version',
        '- update_version => Update your code base with the latest version',
    );

    public function json_version() {
        $json = file_get_contents(__DIR__ . '/../composer.json');
        $json_iterator = json_decode($json, true);
        return $json_iterator['version'];
    }

    public function run_command($arguments) {
        $is_help = sizeof(array_filter($arguments, function($val) {
            return $val == '--help' || $val == '-h';
        })) > 0;
        $command_name = $arguments[1];
        $passable_args = array_slice($arguments, 2);
        $help_lookup = $this->command_name_help_lookup;
        $command_lookup = $this->command_name_lookup;

        $lookup = $is_help ? $help_lookup : $command_lookup;

        $command_exists = array_key_exists($command_name, $lookup) ? 
            $lookup[$command_name] : false;

        if ($command_exists) {
            $command = new $command_exists();
            $command->run($passable_args);
        } else {
            $docs = new DocumentationHelpCommand();
            $string_array = $this->descriptions;
            $description = implode("\n", $string_array);
            $version = $this->json_version();
            $docs->run($description, $version);
        }
        
    }
}
