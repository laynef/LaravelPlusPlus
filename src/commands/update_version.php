<?php

class UpdateVersionCommand
{

    public function run($argv_arguments) {

        $controller_path = getcwd() . '/app/Http/Controllers/';

        $global_controller_str = file_get_contents(__DIR__ . '/../templates/global_controller.txt');
        $global_controller_path = $controller_path . 'GlobalController.php';

        $documentation_controller_str = file_get_contents(__DIR__ . '/../templates/documentation_controller.txt');
        $documentation_controller_path = $controller_path . 'DocumentationController.php';

        $documentation_helper_controller_str = file_get_contents(__DIR__ . '/../templates/documentation_helper_controller.txt');
        $helper_controller_path = $controller_path . 'DocumentationHelperController.php';

        file_put_contents($global_controller_path, $global_controller_str);
        file_put_contents($documentation_controller_path, $documentation_controller_str);
        file_put_contents($helper_controller_path, $documentation_helper_controller_str);

        echo "Updated your base code";
    }

}
