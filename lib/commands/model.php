<?php

function camelCase($str) {
    $i = array("-","_");
    $str = preg_replace('/([a-z])([A-Z])/', "\\1 \\2", $str);
    $str = preg_replace('@[^a-zA-Z0-9\-_ ]+@', '', $str);
    $str = str_replace($i, ' ', $str);
    $str = str_replace(' ', '', ucwords(strtolower($str)));
    $str = strtolower(substr($str,0,1)).substr($str,1);
    return ucfirst($str);
}

$model = camelCase($argv[1]);
$arguments = array_slice($argv, 2);
$script_line = implode($arguments, ' ');

shell_exec('php artisan make:model ' . $model . ' ' . $script_line . '--migration --controller --resource --api');

$model_regex = '/{{ MODEL }}/';

$controller_path = __DIR__ . '/../app/Http/Controllers/' . $model . 'Controller.php';

$template_str = file_get_contents(__DIR__ . '/../templates/controller.txt');

$new_controller_string = preg_replace($model_regex, $model, $template_str);
file_put_contents($controller_path, $new_controller_string);

echo "Your controller was generated.";
