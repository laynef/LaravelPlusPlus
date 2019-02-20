<?php

class InitializeCommand 
{

    public function run($argv_arguments) {
        $global_controller_str = file_get_contents(__DIR__ . '/../templates/global_controller.txt');
        $documentation_blade_str = file_get_contents(__DIR__ . '/../templates/documentation.blade.txt');
        $documentation_controller_str = file_get_contents(__DIR__ . '/../templates/documentation_controller.txt');
        $handler_str = file_get_contents(__DIR__ . '/../templates/handler.txt');
        $documentation_helper_controller_str = file_get_contents(__DIR__ . '/../templates/documentation_helper_controller.txt');
        $routes_str = file_get_contents(getcwd() . '/routes/api.php');
        $web_routes_str = file_get_contents(getcwd() . '/routes/web.php');
        $user_controller_path = getcwd() . '/app/Http/Controllers/UserController.php';

        $controller_path = getcwd() . '/app/Http/Controllers/';
        $route_path = getcwd() . '/routes/api.php';
        $route_template_path = file_get_contents(__DIR__ . '/../templates/routes.txt');

        $web_path = getcwd() . '/routes/web.php';
        $blade_path = getcwd() . '/resources/views/documentation.blade.php';
        $handler_path = getcwd() . '/app/Exceptions/Handler.php';
        $global_controller_path = $controller_path . 'GlobalController.php';
        $documentation_controller_path = $controller_path . 'DocumentationController.php';
        $helper_controller_path = $controller_path . 'DocumentationHelperController.php';

        $route_str = 'use App\\Http\\Controllers\\DocumentationController;';
        $web_str = (string)$web_routes_str . "\nRoute::get('/docs', 'DocumentationController@index');\n";

        $route_array = explode("\n", $routes_str);
        $route_array_merge = array_merge(array_slice(
            $route_array, 0, 2), 
            [$route_str], 
            array_slice($route_array, 2),
            [$route_template_path]
        );

        $model_regex = '/{{ MODEL }}/';
        $model = 'User';
        $template_controller_str = file_get_contents(__DIR__ . '/../templates/controller.txt');
        $new_controller_string = preg_replace($model_regex, $model, $template_controller_str);

        $route_string = implode("\n", $route_array_merge);

        file_put_contents($user_controller_path, $new_controller_string);
        file_put_contents($web_path, $web_str);
        file_put_contents($handler_path, $handler_str);
        file_put_contents($route_path, $route_string);
        file_put_contents($global_controller_path, $global_controller_str);
        file_put_contents($documentation_controller_path, $documentation_controller_str);
        file_put_contents($helper_controller_path, $documentation_helper_controller_str);
        file_put_contents($blade_path, $documentation_blade_str);

        echo "Initialize your project";
    }
}