<?php

class LaravelPlusPlus
{
    public function run_command($arguments) {
        $is_help = sizeof(array_filter($arguments, function($val) {
            return $val == '--help' || $val == '-h';
        })) > 0;
        $command_name = $arguments[0];
        $directory_path = $is_help ? 'help' : 'commands';
        $file_path = __DIR__ . "/{$directory_path}/{$command_name}.php";

        if (file_exists($file_path)) {
            $str_args = implode(' ', $arguments);
            shell_exec("php {$file_path} {$str_args}");
        } else {
            $document_help = __DIR__ . '/help/documentation.php';
            shell_exec("php {$document_help}");
        }
    }
}