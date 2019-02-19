<?php

class InitializeCommand 
{

    public function run($argv_arguments) {
        $global_controller_str = file_get_contents(__DIR__ . '/templates/global_controller.txt');
        $documentation_blade_str = file_get_contents(__DIR__ . '/templates/documentation.blade.txt');
        $documentation_controller_str = file_get_contents(__DIR__ . '/templates/documentation_controller.txt');
        $documentation_helper_controller_str = file_get_contents(__DIR__ . '/templates/documentation_helper_controller.txt');

        $controller_path = __DIR__ . '/app/Http/Controllers/';

        $blade_path = __DIR__ . '/resources/views/documentation.blade.php';
        $global_controller_path = $controller_path . 'GlobalController.php';
        $documentation_controller_path = $controller_path . 'DocumentationController.php';
        $helper_controller_path = $controller_path . 'DocumentationHelperController.php';

        file_put_contents($global_controller_path, $global_controller_str);
        file_put_contents($documentation_controller_path, $documentation_controller_str);
        file_put_contents($helper_controller_path, $documentation_helper_controller_str);
        file_put_contents($blade_path, $documentation_blade_str);

        echo "Initialize your project";
    }
}