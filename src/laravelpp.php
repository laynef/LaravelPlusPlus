<?php

require __DIR__ . '/help/documentation.php';
require __DIR__ . '/help/initialize.php';
require __DIR__ . '/help/make_test.php';
require __DIR__ . '/help/model.php';
require __DIR__ . '/commands/initialize.php';
require __DIR__ . '/commands/make_test.php';
require __DIR__ . '/commands/model.php';


class LaravelPlusPlus
{

    public $command_name_lookup = [
        'i' => InitializeCommand,
        'init' => InitializeCommand,
        'initialize' => InitializeCommand,
        'm' => ModelCommand,
        'model' => ModelCommand,
        'make_test' => ModelTestCommand,
        'mt' => ModelTestCommand,
    ];

    public $command_name_help_lookup = [
        'i' => InitializeHelpCommand,
        'init' => InitializeHelpCommand,
        'initialize' => InitializeHelpCommand,
        'm' => ModelHelpCommand,
        'model' => ModelHelpCommand,
        'make_test' => ModelTestHelpCommand,
        'mt' => ModelTestHelpCommand,
    ];


    public function run_command($arguments) {
        $is_help = sizeof(array_filter($arguments, function($val) {
            return $val == '--help' || $val == '-h';
        })) > 0;
        $command_name = $arguments[1];
        $passable_args = array_slice($arguments, 2);
        $help_lookup = $this->command_name_help_lookup;
        $command_lookup = $this->command_name_lookup;

        $command_exists = $is_help && array_key_exists($command_name, $help_lookup) ? 
            $help_lookup[$command_name] : array_key_exists($command_name, $command_lookup) ?
            $command_lookup[$command_name] : false;

        if ($command_exists) {
            $command = new $command_exists();
            $command->run($passable_args);
        } else {
            $docs = new DocumentationHelpCommand();
            $docs->run();
        }
        
    }
}
