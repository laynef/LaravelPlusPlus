<?php

$resource_name = $argv[1];

$route_regex = '/{{ RESOURCE_ROUTE }}/';
$route_capitalized_regex = '/{{ RESOURCE_ROUTE_CAPTIALIZE }}/';
$route_captialized = ucfirst($resource_name);

$test_path = getcwd() . '/test/Feature/' . $route_captialized . 'Test.php';

$template_str = file_get_contents(getcwd() . '//templates/php_unit_test.txt');

$new_test_string = preg_replace($route_regex, $resource_name, $template_str);
$new_test_string = preg_replace($route_capitalized_regex, $route_captialized, $new_test_string);
file_put_contents($test_path, $new_test_string);

echo "Your test was generated.";
