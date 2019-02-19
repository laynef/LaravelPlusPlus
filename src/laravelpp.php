<?php

class LaravelPlusPlus
{
    public function run_command($arguments) {
        $is_help = sizeof(array_filter($arguments, function($val) {
            return $val == '--help' || $val == '-h';
        })) > 0;
        $command_name = $arguments[1];
        $directory_path = $is_help ? 'help' : 'commands';
        $file_path = getcwd() . "/src/{$directory_path}/{$command_name}.php";
        $bash_path = getcwd() . "/src/bash/run.sh";

        if (file_exists($file_path)) {
            $str_args = implode(' ', $arguments);
            shell_exec("{$bash_path} {$file_path} {$str_args}");
        } else {
            $document_help = getcwd() . '/src/bash/help/documentation.sh';
            shell_exec("{$bash_path} {$document_help}");
        }
    }
}
